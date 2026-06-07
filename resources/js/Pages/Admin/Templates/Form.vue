<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';

const props = defineProps({ template: Object, categories: Object });

const isEdit = computed(() => !!props.template);

const form = useForm({
    name: props.template?.name ?? '',
    description: props.template?.description ?? '',
    category: props.template?.category ?? 'corporate',
    retail_price: props.template?.retail_price ?? 85,
    wholesale_price: props.template?.wholesale_price ?? 55,
    badge: props.template?.badge ?? '',
    sort_order: props.template?.sort_order ?? 0,
    is_active: props.template?.is_active ?? true,
    image: null,
});

const previewUrl = ref(props.template?.preview_image ? '/' + props.template.preview_image : null);

function onFile(e) {
    const f = e.target.files[0];
    form.image = f ?? null;
    if (f) previewUrl.value = URL.createObjectURL(f);
}

function submit() {
    if (isEdit.value) {
        form.transform((d) => ({ ...d, _method: 'post' }))
            .post(route('admin.templates.update', props.template.id), { forceFormData: true });
    } else {
        form.post(route('admin.templates.store'), { forceFormData: true });
    }
}
</script>

<template>
    <Head :title="(isEdit ? 'تعديل' : 'إضافة') + ' قالب'" />
    <AdminLayout :title="isEdit ? 'تعديل القالب' : 'قالب جديد'" subtitle="تفاصيل القالب وأسعاره وصورة المعاينة">

        <Link :href="route('admin.templates.index')" class="back">→ كل القوالب</Link>

        <form @submit.prevent="submit" class="grid">
            <div class="panel">
                <div class="fgrp"><label>اسم القالب</label>
                    <input v-model="form.name" required placeholder="درع التميّز">
                    <div v-if="form.errors.name" class="err">{{ form.errors.name }}</div>
                </div>
                <div class="fgrp"><label>الوصف</label>
                    <textarea v-model="form.description" rows="3" placeholder="وصف مختصر يظهر في بطاقة القالب"></textarea>
                    <div v-if="form.errors.description" class="err">{{ form.errors.description }}</div>
                </div>
                <div class="frow">
                    <div class="fgrp" style="flex:1"><label>التصنيف</label>
                        <select v-model="form.category">
                            <option v-for="(label, key) in categories" :key="key" :value="key">{{ label }}</option>
                        </select>
                    </div>
                    <div class="fgrp" style="flex:1"><label>الشارة (اختياري)</label>
                        <input v-model="form.badge" placeholder="الأكثر مبيعاً">
                    </div>
                </div>
                <div class="frow">
                    <div class="fgrp" style="flex:1"><label>سعر التجزئة (₪)</label>
                        <input type="number" step="0.01" min="0" v-model="form.retail_price" required>
                        <div v-if="form.errors.retail_price" class="err">{{ form.errors.retail_price }}</div>
                    </div>
                    <div class="fgrp" style="flex:1"><label>سعر الجملة (₪)</label>
                        <input type="number" step="0.01" min="0" v-model="form.wholesale_price" required>
                        <div v-if="form.errors.wholesale_price" class="err">{{ form.errors.wholesale_price }}</div>
                    </div>
                </div>
                <div class="frow">
                    <div class="fgrp" style="flex:1"><label>الترتيب</label>
                        <input type="number" min="0" v-model="form.sort_order">
                    </div>
                    <label class="toggle">
                        <input type="checkbox" v-model="form.is_active">
                        <span>مفعّل ومعروض في المتجر</span>
                    </label>
                </div>
            </div>

            <aside class="panel">
                <label class="up" :class="{ has: previewUrl }">
                    <img v-if="previewUrl" :src="previewUrl" alt="معاينة">
                    <div v-else class="upph"><div class="big">🖼</div>اضغط لرفع صورة المعاينة</div>
                    <input type="file" accept=".jpg,.jpeg,.png,.webp" hidden @change="onFile">
                </label>
                <div v-if="form.errors.image" class="err">{{ form.errors.image }}</div>
                <p class="hint">JPG / PNG / WEBP — حتى 5MB. يُفضّل نسبة 4:3.</p>
                <button class="submit" :disabled="form.processing">
                    {{ form.processing ? 'جارٍ الحفظ…' : (isEdit ? 'حفظ التعديلات' : 'إضافة القالب') }}<span class="bib">←</span>
                </button>
            </aside>
        </form>
    </AdminLayout>
</template>

<style scoped>
.back{display:inline-block;margin-bottom:18px;color:var(--muted);font-size:14px;text-decoration:none}
.back:hover{color:var(--ink)}
.grid{display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start}
.panel{background:var(--bg2);border:1px solid var(--hair);border-radius:20px;padding:22px}
.fgrp{margin-bottom:16px}
.fgrp label{display:block;font-size:12px;color:var(--muted);margin-bottom:7px}
.fgrp input,.fgrp select,.fgrp textarea{width:100%;background:var(--glass);border:1px solid var(--hair);border-radius:11px;padding:11px 13px;color:var(--ink);font-family:inherit;font-size:14px;outline:none;transition:border .3s var(--ease)}
.fgrp input:focus,.fgrp select:focus,.fgrp textarea:focus{border-color:var(--emerald)}
.frow{display:flex;gap:14px}
.toggle{display:flex;align-items:center;gap:9px;font-size:13px;color:var(--ink);cursor:pointer;align-self:flex-end;padding-bottom:13px}
.toggle input{accent-color:var(--emerald);width:17px;height:17px}
.err{color:#ff7a6b;font-size:12px;margin-top:6px}
.up{display:block;border:1.5px dashed var(--hair2);border-radius:16px;overflow:hidden;cursor:pointer;aspect-ratio:4/3;transition:border .3s}
.up:hover{border-color:var(--emerald)}
.up.has{border-style:solid}
.up img{width:100%;height:100%;object-fit:cover;display:block}
.upph{height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--muted);font-size:13px;gap:6px}
.upph .big{font-size:34px}
.hint{color:var(--muted);font-size:12px;font-weight:300;margin:12px 0 18px;line-height:1.7}
.submit{width:100%;display:flex;align-items:center;justify-content:center;gap:9px;background:linear-gradient(150deg,var(--emerald-soft),var(--emerald-deep));color:var(--on-emerald);border:none;border-radius:13px;padding:14px;font-size:14px;font-weight:600;cursor:pointer;font-family:inherit}
.submit:disabled{opacity:.6}
.bib{width:24px;height:24px;border-radius:999px;background:rgba(3,26,13,.2);display:flex;align-items:center;justify-content:center}
@media(max-width:860px){.grid{grid-template-columns:1fr}}
</style>
