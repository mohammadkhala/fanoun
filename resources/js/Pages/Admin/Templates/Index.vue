<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({ templates: Array, categories: Object });

const money = (n) => '₪' + Number(n).toLocaleString('en-US');

function toggle(t) {
    router.patch(route('admin.templates.toggle', t.id), {}, { preserveScroll: true });
}
function destroy(t) {
    if (confirm('حذف القالب "' + t.name + '"؟ لا يمكن التراجع.')) {
        router.delete(route('admin.templates.destroy', t.id), { preserveScroll: true });
    }
}
</script>

<template>
    <Head title="القوالب — الإدارة" />
    <AdminLayout title="إدارة القوالب" subtitle="أضف وعدّل قوالب الدروع المعروضة في المتجر">

        <div class="head">
            <div class="count">{{ templates.length }} قالب</div>
            <Link :href="route('admin.templates.create')" class="add">＋ قالب جديد</Link>
        </div>

        <p v-if="!templates.length" class="empty">لا توجد قوالب بعد. ابدأ بإضافة أول قالب.</p>

        <div v-else class="tgrid">
            <div v-for="t in templates" :key="t.id" class="tcard" :class="{ off: !t.is_active }">
                <div class="tprev">
                    <img v-if="t.preview_image" :src="'/' + t.preview_image" :alt="t.name">
                    <div v-else class="noimg">🛡</div>
                    <span v-if="t.badge" class="tbadge">{{ t.badge }}</span>
                    <span class="tstate" :class="t.is_active ? 'on' : 'hidden'">{{ t.is_active ? 'مفعّل' : 'مخفي' }}</span>
                </div>
                <div class="tbody">
                    <div class="tname">{{ t.name }}</div>
                    <div class="tcat">{{ t.category_label }}</div>
                    <div class="tprices">
                        <span>تجزئة <b>{{ money(t.retail_price) }}</b></span>
                        <span>جملة <b>{{ money(t.wholesale_price) }}</b></span>
                    </div>
                    <div class="tmeta">{{ t.designs_count }} تصميم مرتبط</div>
                </div>
                <div class="tacts">
                    <Link :href="route('admin.templates.edit', t.id)" class="act edit">تعديل</Link>
                    <button class="act" @click="toggle(t)">{{ t.is_active ? 'إخفاء' : 'تفعيل' }}</button>
                    <button class="act del" @click="destroy(t)">حذف</button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
.head{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px}
.count{color:var(--muted);font-size:14px}
.add{background:linear-gradient(150deg,var(--emerald-soft),var(--emerald-deep));color:var(--on-emerald);border:none;border-radius:12px;padding:11px 20px;font-size:14px;font-weight:600;text-decoration:none}
.tgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:18px}
.tcard{background:var(--bg2);border:1px solid var(--hair);border-radius:18px;overflow:hidden;transition:transform .3s var(--ease)}
.tcard:hover{transform:translateY(-3px)}
.tcard.off{opacity:.6}
.tprev{position:relative;aspect-ratio:4/3;background:var(--glass);display:flex;align-items:center;justify-content:center;overflow:hidden}
.tprev img{width:100%;height:100%;object-fit:cover}
.noimg{font-size:40px}
.tbadge{position:absolute;top:10px;right:10px;background:rgba(0,0,0,.55);color:#fff;font-size:11px;padding:4px 10px;border-radius:999px;backdrop-filter:blur(6px)}
.tstate{position:absolute;top:10px;left:10px;font-size:11px;padding:4px 10px;border-radius:999px;font-weight:600}
.tstate.on{background:rgba(52,215,127,.85);color:#031a0d}
.tstate.hidden{background:rgba(0,0,0,.55);color:#fff}
.tbody{padding:14px 16px}
.tname{font-weight:700;font-size:15px}
.tcat{color:var(--muted);font-size:12px;margin-top:3px}
.tprices{display:flex;gap:14px;margin-top:12px;font-size:12px;color:var(--muted)}
.tprices b{color:var(--ink);font-size:14px}
.tmeta{color:var(--muted);font-size:12px;margin-top:10px}
.tacts{display:flex;border-top:1px solid var(--hair)}
.act{flex:1;background:none;border:none;border-left:1px solid var(--hair);padding:11px;font-size:13px;color:var(--muted);cursor:pointer;font-family:inherit;text-decoration:none;text-align:center;transition:all .25s var(--ease)}
.act:last-child{border-left:none}
.act:hover{background:var(--glass);color:var(--ink)}
.act.edit{color:var(--emerald-soft)}
.act.del:hover{color:#ff7a6b}
.empty{color:var(--muted);text-align:center;padding:50px;font-size:14px}
</style>
