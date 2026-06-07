<script setup>
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { computed } from 'vue';

const props = defineProps({ admins: Array });
const me = computed(() => usePage().props.auth?.user);

const form = useForm({ name: '', email: '', phone: '', password: '', password_confirmation: '' });

function submit() {
    form.post(route('admin.users.store'), { preserveScroll: true, onSuccess: () => form.reset() });
}
function destroy(u) {
    if (confirm('حذف المدير "' + u.name + '"؟')) router.delete(route('admin.users.destroy', u.id), { preserveScroll: true });
}
</script>

<template>
    <Head title="المستخدمون — الإدارة" />
    <AdminLayout title="المستخدمون" subtitle="إدارة حسابات المدراء وصلاحيات الدخول">
        <div class="cols">
            <form @submit.prevent="submit" class="panel">
                <h3>إضافة مدير</h3>
                <div class="fgrp"><label>الاسم</label><input v-model="form.name" required>
                    <div v-if="form.errors.name" class="err">{{ form.errors.name }}</div></div>
                <div class="fgrp"><label>البريد الإلكتروني</label><input type="email" v-model="form.email" class="lat" required>
                    <div v-if="form.errors.email" class="err">{{ form.errors.email }}</div></div>
                <div class="fgrp"><label>الهاتف</label><input v-model="form.phone" class="lat"></div>
                <div class="fgrp"><label>كلمة المرور</label><input type="password" v-model="form.password" required>
                    <div v-if="form.errors.password" class="err">{{ form.errors.password }}</div></div>
                <div class="fgrp"><label>تأكيد كلمة المرور</label><input type="password" v-model="form.password_confirmation" required></div>
                <button class="submit" :disabled="form.processing">إنشاء الحساب</button>
            </form>

            <div class="panel">
                <div class="table">
                    <div class="thead"><span>المدير</span><span>الهاتف</span><span>التسجيل</span><span></span></div>
                    <div v-for="u in admins" :key="u.id" class="row">
                        <div class="who">
                            <div class="av">{{ (u.name || '?').charAt(0) }}</div>
                            <div><div class="nm">{{ u.name }}</div><div class="sub lat">{{ u.email }}</div></div>
                        </div>
                        <span class="muted lat">{{ u.phone || '—' }}</span>
                        <span class="muted lat">{{ u.created_at }}</span>
                        <div class="rowacts">
                            <span v-if="u.id === me?.id" class="self">أنت</span>
                            <button v-else class="q bad" @click="destroy(u)">حذف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
.cols{display:grid;grid-template-columns:320px 1fr;gap:20px;align-items:start}
.panel{background:var(--bg2);border:1px solid var(--hair);border-radius:20px;padding:22px}
h3{font-size:15px;font-weight:700;margin-bottom:16px}
.fgrp{margin-bottom:13px}
.fgrp label{display:block;font-size:12px;color:var(--muted);margin-bottom:6px}
.fgrp input{width:100%;background:var(--glass);border:1px solid var(--hair);border-radius:11px;padding:10px 12px;color:var(--ink);font-family:inherit;font-size:14px;outline:none}
.fgrp input:focus{border-color:var(--emerald)}
.lat{direction:ltr;text-align:left}
.submit{background:linear-gradient(150deg,var(--emerald-soft),var(--emerald-deep));color:var(--on-emerald);border:none;border-radius:12px;padding:11px 22px;font-size:14px;font-weight:600;cursor:pointer;font-family:inherit;margin-top:6px}
.err{color:#ff7a6b;font-size:12px;margin-top:5px}
.table{display:flex;flex-direction:column}
.thead,.row{display:grid;grid-template-columns:2fr 1fr 1fr auto;align-items:center;gap:12px}
.thead{padding:8px 12px 12px;color:var(--muted);font-size:12px;border-bottom:1px solid var(--hair)}
.row{padding:12px;border-radius:11px}
.row:hover{background:var(--glass)}
.who{display:flex;align-items:center;gap:11px}
.av{width:36px;height:36px;border-radius:10px;background:linear-gradient(150deg,var(--emerald-soft),var(--emerald-deep));color:var(--on-emerald);display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0}
.nm{font-weight:600;font-size:14px}.sub{color:var(--muted);font-size:12px;margin-top:2px}
.muted{color:var(--muted);font-size:13px}
.rowacts{justify-self:end}
.self{font-size:12px;color:var(--emerald-soft);font-weight:600}
.q{border:none;border-radius:8px;padding:6px 12px;font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;background:rgba(231,76,60,.1);color:#ff7a6b}
@media(max-width:900px){.cols{grid-template-columns:1fr}.thead{display:none}.row{grid-template-columns:1fr auto;row-gap:6px}}
</style>
