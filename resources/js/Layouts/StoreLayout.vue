<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';
import { computed, onMounted, ref, watch, nextTick } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user);
const cartCount = computed(() => page.props.cartCount ?? 0);
const settings = computed(() => page.props.settings ?? {});
const flashSuccess = computed(() => page.props.flash?.success);
const flashError = computed(() => page.props.flash?.error);

const isDark = ref(false);

function applyTheme() {
    if (isDark.value) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('elite-theme', 'dark');
    } else {
        document.documentElement.removeAttribute('data-theme');
        localStorage.setItem('elite-theme', 'light');
    }
}
function toggleTheme() {
    isDark.value = !isDark.value;
    applyTheme();
}

function goCart() {
    router.visit(user.value ? route('cart.index') : route('login'));
}

// Scroll reveal
function initReveal() {
    const io = new IntersectionObserver(
        (entries) => entries.forEach((e) => { if (e.isIntersecting) e.target.classList.add('in'); }),
        { threshold: 0.14 }
    );
    document.querySelectorAll('.rv').forEach((el) => io.observe(el));
}

onMounted(() => {
    isDark.value = localStorage.getItem('elite-theme') === 'dark';
    nextTick(initReveal);
});

// Re-run reveal on Inertia navigation
watch(() => page.component, () => nextTick(initReveal));
</script>

<template>
    <div>
        <div class="mesh"></div>
        <div class="grain"></div>

        <!-- NAV -->
        <nav>
            <div class="nav-pill">
                <Link :href="route('home')" class="logo"><img src="/logo.png" alt="Elite" class="logo-img"></Link>
                <div class="nlinks">
                    <Link :href="route('home')">الرئيسية</Link>
                    <Link :href="route('categories')">التصنيفات</Link>
                    <Link :href="route('shop')">المتجر</Link>
                    <Link :href="route('track')">تتبع طلبي</Link>
                    <Link :href="route('about')">من نحن</Link>
                    <Link :href="route('contact')">اتصل بنا</Link>
                </div>
                <div class="nav-cta">
                    <template v-if="user">
                        <Link v-if="user.is_admin" :href="route('admin.dashboard')" class="pill-btn pill-ghost">لوحة الإدارة</Link>
                        <Link :href="route('dashboard')" class="pill-btn pill-ghost">حسابي</Link>
                        <Link :href="route('logout')" method="post" as="button" class="pill-btn pill-fill">خروج</Link>
                    </template>
                    <template v-else>
                        <Link :href="route('login')" class="pill-btn pill-ghost">دخول</Link>
                        <Link :href="route('register')" class="pill-btn pill-fill">حساب جديد<span class="bib">←</span></Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- flash -->
        <transition name="fade">
            <div v-if="flashSuccess" class="flash flash-ok">{{ flashSuccess }}</div>
        </transition>
        <transition name="fade">
            <div v-if="flashError" class="flash flash-err">{{ flashError }}</div>
        </transition>

        <slot />

        <!-- FOOTER -->
        <div class="wrap">
            <footer>
                <div class="fg">
                    <div class="fb">
                        <div class="logo"><img src="/logo.png" alt="Elite" class="logo-img logo-img-lg"></div>
                        <p>متخصصون في تصنيع الدروع والهدايا التذكارية الفاخرة. نحوّل أفكارك إلى قطع فنية خالدة بأدق التفاصيل.</p>
                        <div class="fsocial">
                            <a v-if="settings.instagram" :href="settings.instagram" target="_blank" rel="noopener">Instagram</a>
                            <a v-if="settings.facebook" :href="settings.facebook" target="_blank" rel="noopener">Facebook</a>
                            <a v-if="settings.tiktok" :href="settings.tiktok" target="_blank" rel="noopener">TikTok</a>
                        </div>
                    </div>
                    <div class="fc">
                        <h4>روابط</h4>
                        <Link :href="route('home')">الرئيسية</Link>
                        <Link :href="route('categories')">التصنيفات</Link>
                        <Link :href="route('shop')">المتجر</Link>
                    </div>
                    <div class="fc">
                        <h4>الشركة</h4>
                        <Link :href="route('about')">من نحن</Link>
                        <Link :href="route('faq')">الأسئلة الشائعة</Link>
                        <Link :href="route('contact')">اتصل بنا</Link>
                    </div>
                    <div class="fc">
                        <h4>تواصل</h4>
                        <div class="ci"><span class="ico">📞</span> {{ settings.phone }}</div>
                        <div class="ci"><span class="ico">📧</span> {{ settings.email }}</div>
                        <div class="ci"><span class="ico">📍</span> {{ settings.address }}</div>
                        <div class="ci"><span class="ico">🕐</span> {{ settings.working_hours }}</div>
                    </div>
                </div>
                <div class="fbot">
                    <div>© 2024 {{ settings.store_name }} — جميع الحقوق محفوظة</div>
                    <div style="display:flex;gap:20px"><a href="#">الخصوصية</a><a href="#">الشروط</a></div>
                </div>
            </footer>
        </div>

        <!-- FLOATING DOCK -->
        <div class="fab-dock">
            <button class="fab-btn" @click="toggleTheme" :title="isDark ? 'الوضع النهاري' : 'الوضع الليلي'">{{ isDark ? '☀️' : '🌙' }}</button>
            <button class="fab-btn" @click="goCart" title="السلة">🛒<span class="cart-count">{{ cartCount }}</span></button>
        </div>
    </div>
</template>

<style scoped>
.flash{position:fixed;top:26px;right:50%;transform:translateX(50%);z-index:300;padding:12px 24px;border-radius:999px;font-weight:600;font-size:14px;box-shadow:0 18px 50px var(--shadow)}
.flash-ok{background:var(--emerald);color:var(--on-emerald)}
.flash-err{background:#e74c3c;color:#fff}
.fade-enter-active,.fade-leave-active{transition:opacity .4s var(--ease)}
.fade-enter-from,.fade-leave-to{opacity:0}
.fsocial{display:flex;gap:14px;margin-top:14px}
.fsocial a{color:var(--muted);font-size:13px;text-decoration:none;transition:color .3s var(--ease)}
.fsocial a:hover{color:var(--emerald)}
</style>
