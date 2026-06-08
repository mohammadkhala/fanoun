<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, shallowRef } from 'vue';

const props = defineProps({
    template:    Object,
    polotnoKey:  String,
});

/* ── state ── */
const editorEl   = ref(null);
const isLoading  = ref(true);
const loadError  = ref(null);
const storeRef   = shallowRef(null);
let   destroyFn  = null;

/* ── Inertia form for cart submission ── */
const form = useForm({ file: null, quantity: 1 });

/* ── Bootstrap Polotno ── */
onMounted(async () => {
    try {
        // Dynamic import keeps Polotno out of the main bundle
        const [
            { createPolotnoApp },
            { createStore },
        ] = await Promise.all([
            import('polotno'),
            import('polotno/model/store'),
        ]);

        // also import the Blueprint CSS for Polotno's icons/buttons
        await import('polotno/polotno.blueprint.css').catch(() => {});

        // Create Polotno instance directly into the DOM element
        const { store, destroy } = createPolotnoApp({
            container:   editorEl.value,
            key:         props.polotnoKey,
            showCredit:  false,
        });

        destroyFn  = destroy;
        storeRef.value = store;

        // ── Canvas dimensions: 800 × 600 (portrait A4 ≈ 595×842)
        store.setSize(800, 600);

        // ── Load template preview image as locked background
        if (props.template.preview_image) {
            const bgUrl = window.location.origin + '/storage/' + props.template.preview_image;
            const page  = store.pages[0] ?? store.addPage();

            page.addElement({
                type:            'image',
                src:             bgUrl,
                x:               0,
                y:               0,
                width:           store.width,
                height:          store.height,
                selectable:      false,
                draggable:       false,
                removable:       false,
                alwaysOnTop:     false,
                contentEditable: false,
                styleEditable:   false,
            });
        }

        isLoading.value = false;

    } catch (err) {
        console.error('Polotno load error:', err);
        loadError.value = 'تعذّر تحميل المحرر. تحقق من اتصال الإنترنت وأعد المحاولة.';
        isLoading.value = false;
    }
});

onUnmounted(() => {
    destroyFn?.();
});

/* ── Export & add to cart ── */
async function addToCart() {
    if (! storeRef.value || form.processing) return;

    // Export current design as PNG (2× DPI for print quality)
    const blob = await storeRef.value.toBlob({ mimeType: 'image/png', pixelRatio: 2 });
    const file = new File([blob], 'design.png', { type: 'image/png' });

    form.file = file;
    form.post(route('canva.submit.store', props.template.id), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head :title="'تصميم: ' + template.name" />

    <!-- Full-screen editor shell — no StoreLayout footer, just minimal nav replica -->
    <div class="de-shell">

        <!-- ── Top bar ── -->
        <header class="de-bar">
            <div class="de-bar-r">
                <Link :href="route('product.show', template.product.slug)" class="de-back">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none"
                         stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                    رجوع
                </Link>
                <div class="de-info">
                    <span class="de-tname">{{ template.name }}</span>
                    <span class="de-pname">{{ template.product.name }}</span>
                </div>
            </div>

            <div class="de-bar-l">
                <!-- Quantity -->
                <div class="de-qty">
                    <button type="button" class="qty-btn" @click="form.quantity = Math.max(1, form.quantity - 1)">−</button>
                    <input v-model.number="form.quantity" type="number" min="1" max="999" class="qty-inp">
                    <button type="button" class="qty-btn" @click="form.quantity = Math.min(999, form.quantity + 1)">+</button>
                </div>

                <!-- Add to cart -->
                <button class="de-cta" :disabled="isLoading || !!loadError || form.processing" @click="addToCart">
                    <svg v-if="form.processing" class="spin" viewBox="0 0 24 24" width="16" height="16"
                         fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="9" stroke-dasharray="30 10"/>
                    </svg>
                    <svg v-else viewBox="0 0 24 24" width="16" height="16" fill="none"
                         stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    {{ form.processing ? 'جارٍ الإضافة…' : 'أضف إلى السلة' }}
                </button>
            </div>
        </header>

        <!-- ── Editor mount point ── -->
        <div class="de-editor-wrap">

            <!-- Loading overlay -->
            <div v-if="isLoading" class="de-loading">
                <div class="loading-spinner"></div>
                <p>جارٍ تحميل المحرر…</p>
            </div>

            <!-- Error state -->
            <div v-else-if="loadError" class="de-error">
                <div class="err-icon">⚠️</div>
                <p>{{ loadError }}</p>
                <button @click="window.location.reload()" class="retry-btn">إعادة المحاولة</button>
            </div>

            <!-- Polotno mounts here -->
            <div ref="editorEl" class="de-polotno" :style="{ opacity: isLoading ? 0 : 1 }"></div>
        </div>
    </div>
</template>

<style scoped>
/* ── Shell ── */
.de-shell {
    display: flex;
    flex-direction: column;
    height: 100vh;
    background: var(--bg, #f5f5f5);
    overflow: hidden;
}

/* ── Top bar ── */
.de-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 0 20px;
    height: 58px;
    flex-shrink: 0;
    background: var(--bg2, #fff);
    border-bottom: 1px solid var(--hair, #e8e8e8);
    z-index: 20;
}
.de-bar-r, .de-bar-l { display: flex; align-items: center; gap: 14px; }

.de-back {
    display: inline-flex; align-items: center; gap: 6px;
    color: var(--muted); font-size: 13px; text-decoration: none;
    background: var(--glass, #f5f5f5); border: 1px solid var(--hair);
    border-radius: 9px; padding: 7px 12px;
    transition: color .2s, border-color .2s;
}
.de-back svg { transform: rotate(180deg); }
.de-back:hover { color: var(--ink); border-color: var(--hair2); }

.de-info { display: flex; flex-direction: column; }
.de-tname { font-size: 14px; font-weight: 700; color: var(--ink); line-height: 1.2; }
.de-pname { font-size: 11px; color: var(--muted); }

/* Quantity */
.de-qty {
    display: flex; align-items: center; gap: 6px;
    background: var(--bg, #f9f9f9); border: 1.5px solid var(--hair);
    border-radius: 10px; padding: 4px 8px;
}
.qty-btn {
    width: 28px; height: 28px; border-radius: 7px;
    background: var(--glass); border: 1px solid var(--hair);
    color: var(--ink); font-size: 16px; font-weight: 600;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
}
.qty-inp {
    width: 44px; text-align: center; background: none; border: none;
    font-size: 15px; font-weight: 700; color: var(--ink);
    font-family: inherit; outline: none;
}

/* CTA */
.de-cta {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(150deg, var(--emerald-soft, #34d77f), var(--emerald-deep, #1a6b40));
    color: var(--on-emerald, #031a0d); border: none; border-radius: 11px;
    padding: 10px 20px; font-size: 14px; font-weight: 700;
    cursor: pointer; font-family: inherit;
    box-shadow: 0 4px 18px rgba(52,215,127,.25);
    transition: all .3s;
    white-space: nowrap;
}
.de-cta:hover:not(:disabled) { transform: translateY(-1px); box-shadow: 0 8px 28px rgba(52,215,127,.35); }
.de-cta:disabled { opacity: .55; cursor: default; transform: none; }

.spin { animation: spin .8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

/* ── Editor area ── */
.de-editor-wrap {
    flex: 1;
    overflow: hidden;
    position: relative;
}

.de-polotno {
    width: 100%;
    height: 100%;
    transition: opacity .3s;
}

/* ── Loading ── */
.de-loading {
    position: absolute; inset: 0;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: 16px; background: var(--bg, #f5f5f5); z-index: 10;
}
.loading-spinner {
    width: 44px; height: 44px; border-radius: 50%;
    border: 3px solid var(--hair, #e8e8e8);
    border-top-color: var(--emerald-soft, #34d77f);
    animation: spin .7s linear infinite;
}
.de-loading p { font-size: 14px; color: var(--muted); }

/* ── Error ── */
.de-error {
    position: absolute; inset: 0;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: 14px; background: var(--bg);
}
.err-icon { font-size: 48px; }
.de-error p { font-size: 14px; color: var(--muted); }
.retry-btn {
    background: var(--glass); border: 1.5px solid var(--hair);
    border-radius: 10px; padding: 10px 20px; font-size: 14px;
    color: var(--ink); cursor: pointer; font-family: inherit;
}
</style>
