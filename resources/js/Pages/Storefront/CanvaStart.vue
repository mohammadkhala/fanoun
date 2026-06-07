<script setup>
import { Head, Link } from '@inertiajs/vue3';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import { onMounted } from 'vue';

const props = defineProps({ template: Object, canvaUrl: String, submitUrl: String });

onMounted(() => {
    // Auto-open Canva in a new tab
    window.open(props.canvaUrl, '_blank', 'noopener');
});
</script>

<template>
    <Head title="فتح كانفا" />
    <StoreLayout>
        <div class="wrap">
            <div class="center-box rv d1">
                <div class="icon">🎨</div>
                <h1 class="title">فُتح كانفا في نافذة جديدة</h1>
                <p class="sub">صمّم قالبك في كانفا، ثم حمّل الملف هنا عند الانتهاء.</p>

                <div class="tmpl-info">
                    <div class="tmpl-img-wrap">
                        <img v-if="template.preview_image" :src="'/storage/' + template.preview_image" :alt="template.name" class="tmpl-img">
                        <div v-else class="tmpl-ph">🎨</div>
                    </div>
                    <div>
                        <div class="tmpl-name">{{ template.name }}</div>
                        <div class="tmpl-prod">{{ template.product.name }}</div>
                    </div>
                </div>

                <div class="actions">
                    <a :href="canvaUrl" target="_blank" rel="noopener" class="open-btn">
                        إعادة فتح كانفا ↗
                    </a>
                    <Link :href="submitUrl" class="upload-btn">
                        انتهيت من التصميم — رفع الملف ←
                    </Link>
                </div>

                <p class="hint">
                    في كانفا: اضغط <strong>مشاركة ← تحميل</strong> لتحميل الملف بصيغة PNG أو PDF
                </p>
            </div>
        </div>
    </StoreLayout>
</template>

<style scoped>
.center-box { max-width: 520px; margin: 60px auto; display: flex; flex-direction: column; align-items: center; gap: 20px; text-align: center; }
.icon { font-size: 64px; animation: float 4s ease-in-out infinite; }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
.title { font-size: 28px; font-weight: 800; margin: 0; }
.sub { font-size: 15px; color: var(--muted); margin: 0; line-height: 1.7; }

.tmpl-info { display: flex; align-items: center; gap: 16px; background: var(--bg2); border: 1px solid var(--hair); border-radius: 16px; padding: 14px 18px; width: 100%; text-align: right; }
.tmpl-img-wrap { width: 56px; height: 56px; border-radius: 12px; overflow: hidden; background: var(--glass); flex-shrink: 0; }
.tmpl-img { width: 100%; height: 100%; object-fit: cover; }
.tmpl-ph { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 24px; }
.tmpl-name { font-weight: 700; font-size: 15px; }
.tmpl-prod { font-size: 13px; color: var(--muted); margin-top: 3px; }

.actions { display: flex; flex-direction: column; gap: 12px; width: 100%; }
.open-btn { display: flex; align-items: center; justify-content: center; background: var(--bg2); border: 1.5px solid var(--hair); border-radius: 16px; padding: 14px; font-size: 15px; font-weight: 600; color: var(--ink); text-decoration: none; transition: all .3s; }
.open-btn:hover { border-color: rgba(52,215,127,.3); }
.upload-btn { display: flex; align-items: center; justify-content: center; background: linear-gradient(150deg, var(--emerald-soft), var(--emerald-deep)); color: var(--on-emerald); border-radius: 16px; padding: 16px; font-size: 15px; font-weight: 700; text-decoration: none; transition: all .3s; box-shadow: 0 8px 28px rgba(52,215,127,.25); }
.upload-btn:hover { transform: translateY(-2px); box-shadow: 0 14px 40px rgba(52,215,127,.35); }

.hint { font-size: 13px; color: var(--muted); background: var(--glass); border: 1px solid var(--hair); border-radius: 12px; padding: 12px 16px; width: 100%; box-sizing: border-box; }
</style>
