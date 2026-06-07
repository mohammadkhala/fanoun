<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import TemplateCard from '@/Components/TemplateCard.vue';

const props = defineProps({ templates: Array, category: String });

const cats = [
    { key: '', label: 'الكل' },
    { key: 'corporate', label: 'تكريم ومؤسسات' },
    { key: 'sports', label: 'رياضة وبطولات' },
    { key: 'academic', label: 'أكاديمي وتخرّج' },
    { key: 'occasion', label: 'مناسبات' },
];

function filter(key) {
    router.get(route('shop'), key ? { category: key } : {}, { preserveScroll: true });
}
</script>

<template>
    <Head title="المتجر" />
    <StoreLayout>
        <div class="wrap">
            <div class="phead">
                <div class="crumb"><Link :href="route('home')">الرئيسية</Link><span class="sep">/</span><span>المتجر</span></div>
                <span class="eyebrow rv">المتجر</span>
                <h1 class="rv d1">قوالب الدروع</h1>
                <p class="rv d2">اختر قالباً وابدأ التخصيص — كل درع يُصمَّم خصيصاً لك قبل الطلب</p>
            </div>
        </div>
        <div class="wrap"><section style="padding-top:30px">
            <div class="filterbar rv">
                <button v-for="c in cats" :key="c.key" class="fchip" :class="{ on: category === c.key || (!category && c.key === '') }" @click="filter(c.key)">{{ c.label }}</button>
            </div>
            <div class="tgrid" style="margin-top:30px">
                <TemplateCard v-for="t in templates" :key="t.id" :template="t" />
            </div>
            <p v-if="!templates.length" style="text-align:center;color:var(--muted);padding:60px 0">لا توجد قوالب في هذا التصنيف حالياً.</p>
        </section></div>
    </StoreLayout>
</template>

<style scoped>
.filterbar{display:flex;flex-wrap:wrap;gap:10px;justify-content:center}
</style>
