<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';
import { fabric } from 'fabric';

const props = defineProps({
    template: Object,   // { id, name, preview_image, fabric_json }
    design: Object,     // { id, name, fabric_json }
    templates: Array,   // [{ id, name, preview_image }]
});

const page = usePage();

const SHIELD_COLORS = [['#5cf09b', '#147a47'], ['#ffe392', '#cf8f1f'], ['#eef3f6', '#9aa7b1'], ['#a0d8ff', '#1565c0'], ['#ffb3a0', '#c0392b'], ['#d9a0ff', '#6c3483'], ['#1a1a1a', '#000']];
const BG_COLORS = ['#050605', '#11201a', '#1b2113', '#1c2226', '#201418', '#0a0a0a'];
const BASE = [
    { name: 'درع التميّز', icon: '⭐', color: 0, title: 'درع التميّز', sub: 'تقديراً للإبداع والتميّز', date: '2024' },
    { name: 'درع البطولة', icon: '🏆', color: 1, title: 'درع البطولة', sub: 'للمركز الأول', date: '2024' },
    { name: 'درع التقدير', icon: '💎', color: 2, title: 'شكر وتقدير', sub: 'عرفاناً بالجهود', date: 'Elite' },
    { name: 'درع التخرّج', icon: '🎓', color: 3, title: 'تفوّق أكاديمي', sub: 'دفعة التميّز', date: '2024' },
];
const FONTS = ['Cairo', 'IBM Plex Sans Arabic', 'Amiri', 'Reem Kufi', 'Space Grotesk'];
const ICONS = ['⭐', '🏆', '👑', '💎', '🥇', '🎖', '🌟', '🕌', '🎓', '🤝', '❤', '✦'];

let canvas = null;
let shieldObj = null;
let curColor = 0;

const activePanel = ref('text');
const activeTpl = ref(0);
const tplName = ref(BASE[0].name);
const zoomLbl = ref('100%');
const canUndo = ref(false);
const canRedo = ref(false);
const submitting = ref(false);

// reactive selection state for properties panel
const sel = reactive({ has: false, type: '', isShield: false, text: '', fontFamily: 'Cairo', fontSize: 20, fill: '#ffffff', opacity: 100 });

const isDark = ref(false);
function applyTheme() {
    if (isDark.value) document.documentElement.setAttribute('data-theme', 'dark');
    else document.documentElement.removeAttribute('data-theme');
}
function toggleTheme() {
    isDark.value = !isDark.value;
    localStorage.setItem('elite-theme', isDark.value ? 'dark' : 'light');
    applyTheme();
}

/* ---- shield ---- */
function shieldPath(w, h) {
    const p = [[.12, 0], [.88, 0], [1, .17], [1, .6], [.5, 1], [0, .6], [0, .17]];
    return p.map((pt, i) => (i ? 'L' : 'M') + (pt[0] * w) + ' ' + (pt[1] * h)).join(' ') + ' Z';
}
function makeShield(colorIdx) {
    const w = 300, h = 380; const [c1, c2] = SHIELD_COLORS[colorIdx];
    const grad = new fabric.Gradient({ type: 'linear', coords: { x1: 0, y1: 0, x2: w, y2: h }, colorStops: [{ offset: 0, color: c1 }, { offset: 1, color: c2 }] });
    return new fabric.Path(shieldPath(w, h), {
        fill: grad, left: 70, top: 60, selectable: true, name: 'shield',
        shadow: new fabric.Shadow({ color: 'rgba(0,0,0,.45)', blur: 30, offsetY: 20 }), hasControls: true,
    });
}

function loadTemplate(i) {
    activeTpl.value = i;
    const t = BASE[i]; curColor = t.color;
    tplName.value = t.name;
    const custom = canvas.getObjects().filter(o => o.custom);
    canvas.clear();
    canvas.backgroundColor = BG_COLORS[1];
    shieldObj = makeShield(t.color); canvas.add(shieldObj);
    const title = new fabric.Textbox(t.title, { left: 220, top: 175, width: 200, fontSize: 26, fontFamily: 'Cairo', fontWeight: '700', fill: '#fff', textAlign: 'center', originX: 'center', name: 'title' });
    const icon = new fabric.Text(t.icon, { left: 220, top: 120, fontSize: 46, originX: 'center', name: 'icon' });
    const sub = new fabric.Textbox(t.sub, { left: 220, top: 215, width: 200, fontSize: 14, fontFamily: 'IBM Plex Sans Arabic', fill: 'rgba(255,255,255,.92)', textAlign: 'center', originX: 'center', name: 'sub' });
    const date = new fabric.Textbox(t.date, { left: 220, top: 250, width: 120, fontSize: 12, fontFamily: 'Space Grotesk', fill: 'rgba(255,255,255,.7)', textAlign: 'center', originX: 'center', name: 'date' });
    canvas.add(icon, title, sub, date);
    custom.forEach(o => canvas.add(o));
    canvas.renderAll(); saveState();
}

/* ---- add objects ---- */
function addText(kind, txt) {
    const sizes = { h1: 30, h2: 20, h3: 14 };
    const t = new fabric.Textbox(txt || 'نص جديد', { left: 220, top: 300, width: 220, fontSize: sizes[kind] || 20, fontFamily: 'Cairo', fontWeight: kind === 'h1' ? '700' : '400', fill: '#ffffff', textAlign: 'center', originX: 'center', custom: true });
    canvas.add(t); canvas.setActiveObject(t); canvas.renderAll(); saveState();
}
function addIcon(ic) { const t = new fabric.Text(ic, { left: 220, top: 300, fontSize: 48, originX: 'center', custom: true }); canvas.add(t); canvas.setActiveObject(t); canvas.renderAll(); saveState(); }
function addShape(s) {
    let o;
    if (s === 'rect') o = new fabric.Rect({ left: 200, top: 300, width: 90, height: 60, fill: '#5cf09b', rx: 8, ry: 8, custom: true });
    else if (s === 'circle') o = new fabric.Circle({ left: 200, top: 300, radius: 40, fill: '#5cf09b', custom: true });
    else o = new fabric.Line([180, 320, 320, 320], { stroke: '#5cf09b', strokeWidth: 4, custom: true });
    canvas.add(o); canvas.setActiveObject(o); canvas.renderAll(); saveState();
}
function uploadImg(e) {
    const f = e.target.files[0]; if (!f) return;
    const r = new FileReader();
    r.onload = ev => fabric.Image.fromURL(ev.target.result, img => { img.scaleToWidth(120); img.set({ left: 200, top: 280, custom: true }); canvas.add(img); canvas.setActiveObject(img); canvas.renderAll(); saveState(); });
    r.readAsDataURL(f);
    e.target.value = '';
}

/* ---- colors ---- */
function setShield(i) {
    curColor = i;
    if (shieldObj) {
        const w = 300, h = 380, [c1, c2] = SHIELD_COLORS[i];
        shieldObj.set('fill', new fabric.Gradient({ type: 'linear', coords: { x1: 0, y1: 0, x2: w, y2: h }, colorStops: [{ offset: 0, color: c1 }, { offset: 1, color: c2 }] }));
        canvas.renderAll(); saveState();
    }
}
function setBg(c) { canvas.backgroundColor = c; canvas.renderAll(); saveState(); }

/* ---- properties ---- */
function rgbToHex(c) {
    if (!c || typeof c !== 'string') return '#ffffff';
    if (c[0] === '#') return c.length === 4 ? '#' + [...c.slice(1)].map(x => x + x).join('') : c;
    const m = c.match(/\d+/g); if (!m) return '#ffffff';
    return '#' + m.slice(0, 3).map(x => (+x).toString(16).padStart(2, '0')).join('');
}
function refreshSel() {
    const o = canvas.getActiveObject();
    if (!o) { sel.has = false; return; }
    sel.has = true;
    sel.type = o.type;
    sel.isShield = o.name === 'shield';
    sel.text = o.text || '';
    sel.fontFamily = o.fontFamily || 'Cairo';
    sel.fontSize = Math.round(o.fontSize || 20);
    sel.fill = rgbToHex(o.fill || o.stroke || '#ffffff');
    sel.opacity = Math.round((o.opacity ?? 1) * 100);
}
function setProp(k, v) { const o = canvas.getActiveObject(); if (!o) return; o.set(k, v); canvas.renderAll(); if (k !== 'text') saveState(); refreshSel(); }
function setFill(v) { const o = canvas.getActiveObject(); if (!o) return; const k = (o.stroke && !o.fill) ? 'stroke' : 'fill'; o.set(k, v); canvas.renderAll(); saveState(); refreshSel(); }
function toggleBold() { const o = canvas.getActiveObject(); if (!o) return; o.set('fontWeight', (o.fontWeight === '700' || o.fontWeight === 'bold') ? '400' : '700'); canvas.renderAll(); saveState(); }
function toggleItalic() { const o = canvas.getActiveObject(); if (!o) return; o.set('fontStyle', o.fontStyle === 'italic' ? 'normal' : 'italic'); canvas.renderAll(); saveState(); }
function delObj() { const o = canvas.getActiveObject(); if (o) { canvas.remove(o); sel.has = false; saveState(); } }
function dupe() { const o = canvas.getActiveObject(); if (!o) return; o.clone(c => { c.set({ left: o.left + 20, top: o.top + 20, custom: true }); canvas.add(c); canvas.setActiveObject(c); canvas.renderAll(); saveState(); }); }
function bringFwd() { const o = canvas.getActiveObject(); if (o) { o.bringForward(); canvas.renderAll(); saveState(); } }
function sendBack() { const o = canvas.getActiveObject(); if (o) { o.sendBackwards(); canvas.renderAll(); saveState(); } }

/* ---- history ---- */
let hist = [], hp = -1, lock = false;
function saveState() {
    if (lock) return;
    hist = hist.slice(0, hp + 1);
    hist.push(JSON.stringify(canvas.toJSON(['name', 'custom'])));
    hp++;
    if (hist.length > 40) { hist.shift(); hp--; }
    updHist();
}
function applyState() {
    lock = true;
    canvas.loadFromJSON(hist[hp], () => { canvas.renderAll(); shieldObj = canvas.getObjects().find(o => o.name === 'shield'); lock = false; updHist(); sel.has = false; });
}
function undo() { if (hp > 0) { hp--; applyState(); } }
function redo() { if (hp < hist.length - 1) { hp++; applyState(); } }
function updHist() { canUndo.value = hp > 0; canRedo.value = hp < hist.length - 1; }

/* ---- zoom ---- */
let z = 1;
function zoom(d) { z = Math.min(2, Math.max(.5, z + d)); canvas.setZoom(z); canvas.setDimensions({ width: 440 * z, height: 560 * z }); zoomLbl.value = Math.round(z * 100) + '%'; }

/* ---- output ---- */
function preview() {
    const url = canvas.toDataURL({ format: 'png', multiplier: 2 });
    const a = document.createElement('a'); a.href = url; a.download = 'elite-design.png'; a.click();
}
function submitDesign() {
    if (!page.props.auth?.user) { router.visit(route('login')); return; }
    submitting.value = true;
    const preview = canvas.toDataURL({ format: 'png', multiplier: 2 });
    const fabric_json = canvas.toJSON(['name', 'custom']);
    router.post(route('designs.store'), {
        template_id: props.template?.id ?? null,
        name: tplName.value,
        fabric_json,
        preview,
        quantity: 1,
    }, {
        onFinish: () => { submitting.value = false; },
    });
}

function onKey(e) {
    if (['INPUT', 'TEXTAREA', 'SELECT'].includes(e.target.tagName)) return;
    if ((e.key === 'Delete' || e.key === 'Backspace') && canvas.getActiveObject()) { e.preventDefault(); delObj(); }
    if (e.ctrlKey && e.key === 'z') { e.preventDefault(); undo(); }
    if (e.ctrlKey && (e.key === 'y' || (e.shiftKey && e.key === 'Z'))) { e.preventDefault(); redo(); }
}

onMounted(() => {
    isDark.value = localStorage.getItem('elite-theme') === 'dark';
    applyTheme();

    canvas = new fabric.Canvas('elite-canvas', { backgroundColor: '#11201a', preserveObjectStacking: true });
    canvas.on('selection:created', refreshSel);
    canvas.on('selection:updated', refreshSel);
    canvas.on('selection:cleared', () => { sel.has = false; });
    canvas.on('object:modified', saveState);

    // Load existing design JSON if editing, else load base template.
    const existing = props.design?.fabric_json || props.template?.fabric_json;
    if (existing) {
        lock = true;
        canvas.loadFromJSON(existing, () => {
            canvas.renderAll();
            shieldObj = canvas.getObjects().find(o => o.name === 'shield');
            lock = false;
            saveState();
        });
        if (props.template?.name) tplName.value = props.template.name;
    } else {
        loadTemplate(0);
    }

    document.addEventListener('keydown', onKey);
});

onBeforeUnmount(() => {
    document.removeEventListener('keydown', onKey);
    if (canvas) canvas.dispose();
});
</script>

<template>
    <Head title="محرّر التصميم" />

    <!-- TOP BAR -->
    <div class="top">
        <div class="top-l">
            <Link :href="route('shop')" class="back">→ المتجر</Link>
        </div>
        <div class="tplname">القالب الحالي: <b>{{ tplName }}</b></div>
        <div class="top-r">
            <button class="theme-tgl" @click="toggleTheme" title="الوضع الليلي/النهاري">{{ isDark ? '☀️' : '🌙' }}</button>
            <button class="tbtn" @click="undo" :disabled="!canUndo">↩ تراجع</button>
            <button class="tbtn" @click="redo" :disabled="!canRedo">↪ إعادة</button>
            <button class="tbtn" @click="preview">⤓ معاينة</button>
            <button class="send" @click="submitDesign" :disabled="submitting">{{ submitting ? 'جارٍ الإرسال…' : 'أضف للسلة' }}<span class="bib">←</span></button>
        </div>
    </div>

    <div class="stage">
        <!-- left rail -->
        <div class="rail">
            <button class="ri" :class="{ on: activePanel === 'text' }" @click="activePanel = 'text'">🅣<span>نص</span></button>
            <button class="ri" :class="{ on: activePanel === 'elements' }" @click="activePanel = 'elements'">✦<span>عناصر</span></button>
            <button class="ri" :class="{ on: activePanel === 'colors' }" @click="activePanel = 'colors'">🎨<span>ألوان</span></button>
            <button class="ri" :class="{ on: activePanel === 'uploads' }" @click="activePanel = 'uploads'">🖼<span>صور</span></button>
            <button class="ri" :class="{ on: activePanel === 'templates' }" @click="activePanel = 'templates'">▦<span>قوالب</span></button>
        </div>

        <!-- side panels -->
        <div class="panel">
            <div v-show="activePanel === 'text'">
                <div class="ph">إضافة نص</div>
                <button class="add-btn" @click="addText('h1')">+ أضف نصاً</button>
                <div class="pl">أنماط جاهزة</div>
                <button class="opt h1" @click="addText('h1', 'عنوان رئيسي')">عنوان رئيسي</button>
                <button class="opt h2" @click="addText('h2', 'عنوان فرعي')">عنوان فرعي</button>
                <button class="opt h3" @click="addText('h3', 'نص عادي صغير')">نص عادي صغير</button>
            </div>

            <div v-show="activePanel === 'elements'">
                <div class="ph">عناصر وأيقونات</div>
                <div class="pl">رموز التكريم</div>
                <div class="elgrid">
                    <div v-for="ic in ICONS" :key="ic" class="el" @click="addIcon(ic)">{{ ic }}</div>
                </div>
                <div class="pl">أشكال</div>
                <div class="row">
                    <button class="tbtn" @click="addShape('rect')">▭ مستطيل</button>
                    <button class="tbtn" @click="addShape('circle')">● دائرة</button>
                    <button class="tbtn" @click="addShape('line')">— خط</button>
                </div>
            </div>

            <div v-show="activePanel === 'colors'">
                <div class="ph">لون الدرع</div>
                <div class="sw">
                    <div v-for="(c, i) in SHIELD_COLORS" :key="i" class="sc" :class="{ on: curColor === i }"
                        :style="{ background: `linear-gradient(150deg,${c[0]},${c[1]})` }" @click="setShield(i)"></div>
                </div>
                <div class="pl">خلفية القالب</div>
                <div class="sw">
                    <div v-for="(c, i) in BG_COLORS" :key="i" class="sc" :style="{ background: c }" @click="setBg(c)"></div>
                </div>
            </div>

            <div v-show="activePanel === 'uploads'">
                <div class="ph">رفع صورة / شعار</div>
                <label class="upl" style="display:block">
                    <div class="big">🖼</div>
                    اسحب الشعار هنا أو اضغط للرفع
                    <input type="file" accept="image/*" hidden @change="uploadImg">
                </label>
                <div class="pl">شعارك سيظهر على الدرع ويمكنك تحريكه وتغيير حجمه</div>
            </div>

            <div v-show="activePanel === 'templates'">
                <div class="ph">اختر قالباً</div>
                <div class="tplgrid">
                    <div v-for="(b, i) in BASE" :key="i" class="tpli" :class="{ on: activeTpl === i }" @click="loadTemplate(i)">{{ b.icon }}</div>
                </div>
                <div class="pl">سيتم استبدال شكل الدرع مع الحفاظ على نصوصك قدر الإمكان</div>
            </div>
        </div>

        <!-- canvas -->
        <div class="work">
            <div class="canvas-host">
                <canvas id="elite-canvas" class="canvas-shadow" width="440" height="560"></canvas>
            </div>
            <div class="zoom">
                <button class="zb" @click="zoom(-.1)">−</button>
                <span class="zlbl">{{ zoomLbl }}</span>
                <button class="zb" @click="zoom(.1)">+</button>
            </div>
        </div>

        <!-- properties -->
        <div class="ctx" :class="{ empty: !sel.has }">
            <div v-if="!sel.has" class="hint">اختر عنصراً على الدرع<br>لتعديل خصائصه<br><br>أو أضف نصاً وعناصر من<br>القائمة على اليمين</div>
            <template v-else>
                <div class="miniact">
                    <button @click="dupe">⧉ نسخ</button>
                    <button @click="bringFwd">↑ أمام</button>
                    <button @click="sendBack">↓ خلف</button>
                </div>

                <template v-if="sel.type === 'textbox' || sel.type === 'text'">
                    <div class="field"><label>النص</label>
                        <textarea :value="sel.text" @input="setProp('text', $event.target.value)"></textarea>
                    </div>
                    <template v-if="sel.type === 'textbox'">
                        <div class="field"><label>الخط</label>
                            <select :value="sel.fontFamily" @change="setProp('fontFamily', $event.target.value)">
                                <option v-for="f in FONTS" :key="f" :value="f">{{ f }}</option>
                            </select>
                        </div>
                        <div class="field"><label>الحجم ({{ sel.fontSize }})</label>
                            <input type="range" min="10" max="80" :value="sel.fontSize" @input="setProp('fontSize', +$event.target.value)">
                        </div>
                        <div class="frow">
                            <button class="tbtn" @click="toggleBold">B عريض</button>
                            <button class="tbtn" @click="toggleItalic">I مائل</button>
                        </div>
                        <div class="field" style="margin-top:12px"><label>المحاذاة</label>
                            <div class="frow">
                                <button class="tbtn" @click="setProp('textAlign', 'right')">يمين</button>
                                <button class="tbtn" @click="setProp('textAlign', 'center')">وسط</button>
                                <button class="tbtn" @click="setProp('textAlign', 'left')">يسار</button>
                            </div>
                        </div>
                    </template>
                    <div class="field"><label>اللون</label>
                        <input type="color" :value="sel.fill" @input="setProp('fill', $event.target.value)">
                    </div>
                </template>

                <div v-else-if="sel.isShield" class="field">
                    <label>لون الدرع</label>
                    <div class="hint" style="text-align:right">غيّر اللون من قائمة الألوان على اليمين 🎨</div>
                </div>

                <div v-else class="field"><label>لون التعبئة</label>
                    <input type="color" :value="sel.fill" @input="setFill($event.target.value)">
                </div>

                <div class="field"><label>الشفافية ({{ sel.opacity }}%)</label>
                    <input type="range" min="10" max="100" :value="sel.opacity" @input="setProp('opacity', +$event.target.value / 100)">
                </div>
                <button class="danger" @click="delObj">🗑 حذف العنصر</button>
            </template>
        </div>
    </div>
</template>

<style scoped>
.top{height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 18px;background:var(--panel);border-bottom:1px solid var(--hair);position:relative;z-index:20}
.top-l,.top-r{display:flex;align-items:center;gap:12px}
.theme-tgl{background:var(--glass);border:1px solid var(--hair);color:var(--ink);border-radius:10px;width:36px;height:36px;font-size:15px;transition:all .3s var(--ease)}
.theme-tgl:hover{border-color:var(--hair2)}
.back{display:flex;align-items:center;gap:7px;color:var(--muted);font-size:13px;background:var(--glass);border:1px solid var(--hair);border-radius:999px;padding:7px 14px;transition:all .4s var(--ease);text-decoration:none}
.back:hover{color:var(--ink);border-color:var(--hair2)}
.tplname{color:var(--muted);font-size:13px;font-weight:300}
.tplname b{color:var(--ink);font-weight:600}
.tbtn{background:var(--glass);border:1px solid var(--hair);color:var(--ink);border-radius:10px;padding:8px 12px;font-size:13px;transition:all .3s var(--ease)}
.tbtn:hover{border-color:var(--hair2)}
.tbtn:disabled{opacity:.35;cursor:default}
.send{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(150deg,var(--emerald-soft),var(--emerald-deep));color:var(--on-emerald);border:none;padding:8px 8px 8px 20px;border-radius:999px;font-size:14px;font-weight:600}
.send:disabled{opacity:.6;cursor:default}
.send .bib{width:28px;height:28px;border-radius:999px;background:rgba(3,26,13,.18);display:flex;align-items:center;justify-content:center}

.stage{display:flex;height:calc(100vh - 60px)}
.rail{width:72px;background:var(--panel);border-left:1px solid var(--hair);display:flex;flex-direction:column;align-items:center;padding:12px 0;gap:6px;z-index:15}
.ri{width:52px;height:52px;border-radius:14px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px;color:var(--muted);font-size:18px;transition:all .35s var(--ease);background:none;border:none}
.ri span{font-size:9px;font-weight:500}
.ri:hover{color:var(--ink)}
.ri.on{background:rgba(52,215,127,.12);color:var(--emerald-soft)}

.panel{width:280px;background:var(--bg2);border-left:1px solid var(--hair);overflow-y:auto;padding:20px}
.ph{font-size:15px;font-weight:700;margin-bottom:16px}
.pl{font-size:11px;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;margin:18px 0 9px}
.pl:first-child{margin-top:0}
.row{display:flex;gap:8px;flex-wrap:wrap}
.add-btn{width:100%;display:flex;align-items:center;justify-content:center;gap:8px;background:linear-gradient(150deg,var(--emerald-soft),var(--emerald-deep));color:var(--on-emerald);border:none;border-radius:12px;padding:12px;font-size:14px;font-weight:600;margin-bottom:10px}
.opt{width:100%;text-align:right;background:var(--glass);border:1px solid var(--hair);color:var(--ink);border-radius:12px;padding:13px 15px;margin-bottom:8px;transition:all .3s var(--ease)}
.opt:hover{border-color:rgba(52,215,127,.35);transform:translateX(-3px)}
.opt.h1{font-size:22px;font-weight:700}.opt.h2{font-size:17px;font-weight:600}.opt.h3{font-size:14px;font-weight:400}
.sw{display:flex;flex-wrap:wrap;gap:8px}
.sc{width:32px;height:32px;border-radius:9px;cursor:pointer;border:2px solid transparent;transition:transform .25s var(--ease)}
.sc:hover{transform:scale(1.12)}.sc.on{border-color:var(--ink)}
.elgrid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px}
.el{aspect-ratio:1;background:var(--glass);border:1px solid var(--hair);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;transition:all .3s var(--ease);cursor:pointer}
.el:hover{background:rgba(52,215,127,.1);transform:translateY(-2px)}
.tplgrid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.tpli{aspect-ratio:3/4;border:1px solid var(--hair);border-radius:14px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .3s var(--ease);overflow:hidden;font-size:34px}
.tpli:hover{border-color:rgba(52,215,127,.4)}
.tpli.on{border-color:var(--emerald);box-shadow:0 0 0 2px rgba(52,215,127,.25)}
.upl{border:1.5px dashed var(--hair2);border-radius:14px;padding:26px 16px;text-align:center;color:var(--muted);font-size:13px;font-weight:300;transition:border .3s;cursor:pointer}
.upl:hover{border-color:var(--emerald)}
.upl .big{font-size:28px;margin-bottom:6px}

.work{flex:1;display:flex;flex-direction:column;background:var(--work-bg);position:relative;overflow:hidden}
.canvas-host{flex:1;display:flex;align-items:center;justify-content:center;position:relative}
.canvas-shadow{box-shadow:0 40px 120px var(--shadow-lg);border-radius:8px}
.zoom{position:absolute;bottom:18px;left:50%;transform:translateX(-50%);display:flex;align-items:center;gap:6px;background:var(--panel);border:1px solid var(--hair);border-radius:999px;padding:6px 8px}
.zb{width:30px;height:30px;border-radius:999px;background:var(--glass);border:1px solid var(--hair);color:var(--ink);font-size:16px}
.zlbl{font-size:12px;color:var(--muted);min-width:42px;text-align:center}

.ctx{width:240px;background:var(--bg2);border-right:1px solid var(--hair);padding:20px;overflow-y:auto}
.ctx.empty{display:flex;align-items:center;justify-content:center;text-align:center}
.ctx .hint{color:var(--muted);font-size:13px;font-weight:300;line-height:1.8}
.field{margin-bottom:16px}
.field label{display:block;font-size:11px;color:var(--muted);letter-spacing:.08em;text-transform:uppercase;margin-bottom:7px}
.field input,.field select,.field textarea{width:100%;background:var(--glass);border:1px solid var(--hair);border-radius:10px;padding:10px 12px;color:var(--ink);font-family:inherit;font-size:13px;outline:none;transition:border .3s}
.field input:focus,.field select:focus,.field textarea:focus{border-color:var(--emerald)}
.field textarea{resize:vertical;min-height:60px}
.frow{display:flex;gap:8px}
input[type=range]{accent-color:var(--emerald)}
.danger{width:100%;background:rgba(231,76,60,.1);border:1px solid rgba(231,76,60,.3);color:#ff7a6b;border-radius:10px;padding:10px;font-size:13px;font-weight:600;margin-top:6px}
.miniact{display:flex;gap:6px;margin-bottom:14px}
.miniact button{flex:1;background:var(--glass);border:1px solid var(--hair);color:var(--ink);border-radius:9px;padding:8px;font-size:12px;transition:all .3s}
.miniact button:hover{border-color:var(--hair2)}
</style>
