<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>محرر التصميم — ايليت دعاية</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

{{-- Fabric.js 5.3 (latest stable) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>

<style>
/* ══════════ Reset & Root ══════════ */
:root{
  --green:#10b46a; --green-d:#0c8f52; --green-10:rgba(16,180,106,.10);
  --navy:#0f1512; --bg:#1a1f1c; --panel:#22282a; --panel2:#2a3230;
  --border:#3a4540; --white:#fff; --text:#e8f0eb; --text-2:#8fa895;
  --red:#e74c3c; --font:'Cairo',sans-serif;
  --toolbar-h:52px; --panel-w:280px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font);background:var(--bg);color:var(--text);
  direction:rtl;height:100vh;display:flex;flex-direction:column;overflow:hidden}

/* ══════════ Top Toolbar ══════════ */
.toolbar{
  height:var(--toolbar-h);background:var(--panel);border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:4px;padding:0 12px;flex-shrink:0;
  position:relative;z-index:10
}
.toolbar-logo{font-size:16px;font-weight:900;color:var(--green);
  margin-left:auto;padding-left:16px;border-left:1px solid var(--border);white-space:nowrap}
.toolbar-logo a{color:inherit;text-decoration:none}

.tb-sep{width:1px;height:28px;background:var(--border);margin:0 6px;flex-shrink:0}

.tb-btn{
  display:inline-flex;align-items:center;gap:6px;padding:6px 10px;
  background:transparent;border:1px solid transparent;border-radius:8px;
  color:var(--text-2);font-family:var(--font);font-size:13px;font-weight:600;
  cursor:pointer;transition:all .15s;white-space:nowrap;flex-shrink:0
}
.tb-btn:hover{background:var(--panel2);border-color:var(--border);color:var(--text)}
.tb-btn.active{background:var(--green-10);border-color:var(--green);color:var(--green)}
.tb-btn.primary{background:var(--green);border-color:var(--green);color:#fff}
.tb-btn.primary:hover{background:var(--green-d)}
.tb-btn.danger{background:rgba(231,76,60,.15);border-color:var(--red);color:var(--red)}
.tb-btn i{font-size:13px}

/* Canvas size dropdown */
.size-select{
  background:var(--panel2);border:1px solid var(--border);border-radius:8px;
  color:var(--text);font-family:var(--font);font-size:12px;padding:5px 10px;
  cursor:pointer;outline:none
}

/* ══════════ Main Layout ══════════ */
.editor-body{flex:1;display:flex;overflow:hidden}

/* Left side panel */
.side-panel{
  width:var(--panel-w);background:var(--panel);border-left:1px solid var(--border);
  display:flex;flex-direction:column;overflow:hidden;flex-shrink:0
}
.side-tabs{display:flex;border-bottom:1px solid var(--border)}
.side-tab{
  flex:1;padding:10px 4px;text-align:center;font-size:12px;font-weight:700;
  color:var(--text-2);cursor:pointer;border-bottom:2px solid transparent;
  transition:all .15s
}
.side-tab.active{color:var(--green);border-bottom-color:var(--green)}
.side-content{flex:1;overflow-y:auto;padding:12px}

/* Section label */
.sec-label{font-size:11px;font-weight:700;color:var(--text-2);
  text-transform:uppercase;letter-spacing:.6px;margin:12px 0 8px}
.sec-label:first-child{margin-top:0}

/* Input row */
.inp-row{display:flex;align-items:center;gap:6px;margin-bottom:8px}
.inp-row label{font-size:12px;color:var(--text-2);flex-shrink:0;min-width:44px}
.inp-full,.inp-half{
  flex:1;background:var(--panel2);border:1px solid var(--border);border-radius:7px;
  color:var(--text);font-family:var(--font);font-size:13px;padding:6px 10px;outline:none
}
.inp-full:focus,.inp-half:focus{border-color:var(--green)}
.inp-half{max-width:80px}
input[type="color"]{
  width:36px;height:30px;padding:2px;border-radius:6px;cursor:pointer;
  background:var(--panel2);border:1px solid var(--border)
}
input[type="range"]{width:100%;accent-color:var(--green)}

/* Font list */
.font-grid{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px}
.font-chip{
  padding:4px 10px;border-radius:20px;font-size:12px;cursor:pointer;
  background:var(--panel2);border:1px solid var(--border);color:var(--text-2);
  transition:all .15s
}
.font-chip.active,.font-chip:hover{background:var(--green-10);border-color:var(--green);color:var(--green)}

/* Align buttons */
.align-row{display:flex;gap:4px;margin-bottom:8px}
.align-btn{
  flex:1;padding:7px;border-radius:7px;background:var(--panel2);
  border:1px solid var(--border);color:var(--text-2);cursor:pointer;
  text-align:center;font-size:13px;transition:all .15s
}
.align-btn:hover,.align-btn.active{background:var(--green-10);border-color:var(--green);color:var(--green)}

/* Template gallery */
.tmpl-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:8px}
.tmpl-card{
  border-radius:8px;overflow:hidden;cursor:pointer;border:2px solid var(--border);
  transition:border-color .15s;aspect-ratio:1
}
.tmpl-card:hover{border-color:var(--green)}
.tmpl-card img{width:100%;height:100%;object-fit:cover}
.tmpl-card.placeholder{
  background:var(--panel2);display:flex;flex-direction:column;
  align-items:center;justify-content:center;gap:4px;font-size:11px;color:var(--text-2)
}
.tmpl-card.placeholder i{font-size:22px;color:var(--border)}

/* Upload zone */
.upload-zone{
  border:2px dashed var(--border);border-radius:10px;padding:24px 16px;
  text-align:center;cursor:pointer;transition:border-color .2s;margin-bottom:8px
}
.upload-zone:hover{border-color:var(--green)}
.upload-zone i{font-size:28px;color:var(--border);margin-bottom:8px;display:block}
.upload-zone p{font-size:12px;color:var(--text-2)}
.upload-zone input{display:none}

/* Layer list */
.layer-item{
  display:flex;align-items:center;gap:8px;padding:7px 8px;border-radius:8px;
  font-size:12px;color:var(--text-2);cursor:pointer;border:1px solid transparent;
  transition:all .15s;margin-bottom:4px
}
.layer-item:hover{background:var(--panel2)}
.layer-item.selected{background:var(--green-10);border-color:var(--green);color:var(--green)}
.layer-item .layer-ico{font-size:12px;flex-shrink:0}
.layer-item .layer-name{flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.layer-item .layer-actions{display:flex;gap:4px;flex-shrink:0}
.layer-action-btn{
  width:22px;height:22px;border-radius:4px;background:transparent;border:none;
  color:var(--text-2);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:10px
}
.layer-action-btn:hover{background:rgba(255,255,255,.1);color:var(--text)}

/* ══════════ Canvas area ══════════ */
.canvas-area{
  flex:1;display:flex;align-items:center;justify-content:center;
  overflow:auto;background:var(--bg);position:relative;
}
.canvas-area::before{
  content:'';position:absolute;inset:0;
  background-image:radial-gradient(circle, #3a4540 1px, transparent 1px);
  background-size:20px 20px;opacity:.4;pointer-events:none
}
#canvas-wrap{position:relative;box-shadow:0 8px 40px rgba(0,0,0,.5);z-index:1}
#main-canvas{display:block}

/* ══════════ Right properties panel ══════════ */
.props-panel{
  width:220px;background:var(--panel);border-right:1px solid var(--border);
  display:flex;flex-direction:column;overflow-y:auto;padding:12px;flex-shrink:0
}
.props-title{font-size:12px;font-weight:800;color:var(--text-2);
  text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px}

/* ══════════ Toast ══════════ */
.toast{
  position:fixed;bottom:24px;left:50%;transform:translateX(-50%);
  background:var(--panel2);border:1px solid var(--border);border-radius:10px;
  padding:10px 20px;font-size:13px;font-weight:600;color:var(--text);
  box-shadow:0 4px 20px rgba(0,0,0,.4);display:none;z-index:9999;
  white-space:nowrap
}

/* ══════════ Scroll ══════════ */
::-webkit-scrollbar{width:5px;height:5px}
::-webkit-scrollbar-track{background:var(--panel)}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:10px}

@media(max-width:768px){
  .side-panel,.props-panel{display:none}
  .toolbar .tb-btn span{display:none}
}
</style>
</head>
<body>

<!-- ══════════ TOP TOOLBAR ══════════ -->
<div class="toolbar">
  <!-- Tools -->
  <button class="tb-btn active" id="tool-select" onclick="setTool('select')" title="اختيار">
    <i class="fa fa-arrow-pointer"></i><span>اختيار</span>
  </button>
  <button class="tb-btn" id="tool-text" onclick="addText()" title="نص">
    <i class="fa fa-font"></i><span>نص</span>
  </button>
  <button class="tb-btn" onclick="addRect()" title="مستطيل">
    <i class="fa fa-square"></i><span>شكل</span>
  </button>
  <button class="tb-btn" onclick="addCircle()" title="دائرة">
    <i class="fa fa-circle"></i><span>دائرة</span>
  </button>
  <button class="tb-btn" onclick="triggerUpload()" title="رفع صورة">
    <i class="fa fa-image"></i><span>صورة</span>
  </button>
  <input type="file" id="img-upload" accept="image/*" style="display:none" onchange="uploadImage(event)">

  <div class="tb-sep"></div>

  <!-- Canvas size -->
  <select class="size-select" onchange="changeCanvasSize(this.value)" title="حجم القماش">
    <option value="800x800">مربع (800×800)</option>
    <option value="1200x630">بانر ويب (1200×630)</option>
    <option value="1080x1920">ستوري (1080×1920)</option>
    <option value="900x300">لافتة (900×300)</option>
    <option value="400x400">ملصق (400×400)</option>
    <option value="595x842">A4 بورتريه</option>
    <option value="842x595">A4 لاندسكيب</option>
  </select>

  <div class="tb-sep"></div>

  <!-- History -->
  <button class="tb-btn" onclick="undo()" title="تراجع"><i class="fa fa-rotate-left"></i></button>
  <button class="tb-btn" onclick="redo()" title="إعادة"><i class="fa fa-rotate-right"></i></button>

  <div class="tb-sep"></div>

  <!-- Object actions -->
  <button class="tb-btn" onclick="deleteSelected()" title="حذف"><i class="fa fa-trash"></i></button>
  <button class="tb-btn" onclick="cloneSelected()" title="نسخ"><i class="fa fa-copy"></i></button>
  <button class="tb-btn" onclick="bringForward()" title="للأمام"><i class="fa fa-layer-group"></i></button>
  <button class="tb-btn" onclick="sendBackward()" title="للخلف"><i class="fa fa-layer-group fa-flip-vertical"></i></button>

  <div class="tb-sep"></div>

  <!-- Export -->
  <button class="tb-btn" onclick="saveJSON()" title="حفظ"><i class="fa fa-floppy-disk"></i><span>حفظ</span></button>
  <button class="tb-btn primary" onclick="exportPNG()" title="تنزيل PNG">
    <i class="fa fa-download"></i><span>تنزيل</span>
  </button>

  <div class="toolbar-logo"><a href="/storefront">✦ ايليت دعاية</a></div>
</div>

<!-- ══════════ EDITOR BODY ══════════ -->
<div class="editor-body">

  <!-- ── Left panel ── -->
  <div class="side-panel">
    <div class="side-tabs">
      <div class="side-tab active" onclick="switchSideTab('elements')">عناصر</div>
      <div class="side-tab" onclick="switchSideTab('templates')">قوالب</div>
      <div class="side-tab" onclick="switchSideTab('layers')">طبقات</div>
    </div>

    <!-- ELEMENTS tab -->
    <div class="side-content" id="tab-elements">
      <div class="sec-label">نص</div>
      <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:8px">
        <button class="tb-btn" style="flex:1" onclick="addText('عنوان رئيسي', 36, 'bold')">
          <i class="fa fa-heading"></i> عنوان
        </button>
        <button class="tb-btn" style="flex:1" onclick="addText('نص فرعي', 20)">
          <i class="fa fa-font"></i> فرعي
        </button>
        <button class="tb-btn" style="flex:1;width:100%" onclick="addText('نص عادي', 16)">
          <i class="fa fa-align-right"></i> نص
        </button>
      </div>

      <div class="sec-label">أشكال</div>
      <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:8px">
        <button class="tb-btn" onclick="addRect()"><i class="fa fa-square"></i></button>
        <button class="tb-btn" onclick="addCircle()"><i class="fa fa-circle"></i></button>
        <button class="tb-btn" onclick="addTriangle()"><i class="fa fa-play fa-rotate-270"></i></button>
        <button class="tb-btn" onclick="addLine()"><i class="fa fa-minus"></i></button>
        <button class="tb-btn" onclick="addStar()"><i class="fa fa-star"></i></button>
      </div>

      <div class="sec-label">صور وخلفية</div>
      <div class="upload-zone" onclick="triggerUpload()">
        <input type="file" id="img-upload2" accept="image/*" onchange="uploadImage(event)">
        <i class="fa fa-cloud-arrow-up"></i>
        <p>اضغط لرفع صورة</p>
      </div>

      <!-- Background colors -->
      <div class="sec-label">لون الخلفية</div>
      <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:8px">
        @foreach(['#ffffff','#000000','#ff6b6b','#4ecdc4','#45b7d1','#96ceb4','#ffeaa7','#dda0dd','#1a1f1c','#f5f0eb'] as $c)
          <div style="width:28px;height:28px;background:{{ $c }};border-radius:6px;cursor:pointer;border:2px solid rgba(255,255,255,.2)"
               onclick="setBackground('{{ $c }}')" title="{{ $c }}"></div>
        @endforeach
        <label title="لون مخصص" style="width:28px;height:28px;border-radius:6px;cursor:pointer;overflow:hidden">
          <input type="color" style="width:36px;height:36px;margin:-4px;cursor:pointer;border:none" onchange="setBackground(this.value)">
        </label>
      </div>
    </div>

    <!-- TEMPLATES tab -->
    <div class="side-content" id="tab-templates" style="display:none">
      <div class="sec-label">قوالب جاهزة</div>
      <div class="tmpl-grid" id="templates-grid">
        <div class="tmpl-card placeholder" onclick="loadTemplate('tshirt')">
          <i class="fa fa-shirt"></i><span>تيشرت</span>
        </div>
        <div class="tmpl-card placeholder" onclick="loadTemplate('mug')">
          <i class="fa fa-mug-hot"></i><span>كوب</span>
        </div>
        <div class="tmpl-card placeholder" onclick="loadTemplate('sticker')">
          <i class="fa fa-star"></i><span>ملصق</span>
        </div>
        <div class="tmpl-card placeholder" onclick="loadTemplate('banner')">
          <i class="fa fa-image"></i><span>بانر</span>
        </div>
        <div class="tmpl-card placeholder" onclick="loadTemplate('card')">
          <i class="fa fa-id-card"></i><span>بطاقة</span>
        </div>
        <div class="tmpl-card placeholder" onclick="loadTemplate('logo')">
          <i class="fa fa-pen-fancy"></i><span>لوغو</span>
        </div>
      </div>
    </div>

    <!-- LAYERS tab -->
    <div class="side-content" id="tab-layers" style="display:none">
      <div class="sec-label">الطبقات</div>
      <div id="layers-list"></div>
    </div>
  </div>

  <!-- ── Canvas area ── -->
  <div class="canvas-area" id="canvas-area">
    <div id="canvas-wrap">
      <canvas id="main-canvas"></canvas>
    </div>
  </div>

  <!-- ── Right properties panel ── -->
  <div class="props-panel">
    <div class="props-title">خصائص العنصر</div>

    <!-- Text properties -->
    <div id="props-text" style="display:none">
      <div class="sec-label">الخط</div>
      <div class="font-grid" id="font-list"></div>

      <div class="inp-row">
        <label>حجم</label>
        <input type="number" class="inp-half" id="prop-fsize" min="6" max="300"
               oninput="setProp('fontSize', +this.value)">
      </div>

      <div class="inp-row">
        <label>لون</label>
        <input type="color" id="prop-fcolor" onchange="setProp('fill', this.value)">
      </div>

      <div class="align-row">
        <button class="align-btn" onclick="setProp('textAlign','right')"><i class="fa fa-align-right"></i></button>
        <button class="align-btn" onclick="setProp('textAlign','center')"><i class="fa fa-align-center"></i></button>
        <button class="align-btn" onclick="setProp('textAlign','left')"><i class="fa fa-align-left"></i></button>
      </div>

      <div class="align-row">
        <button class="align-btn" id="btn-bold" onclick="toggleBold()"><i class="fa fa-bold"></i></button>
        <button class="align-btn" id="btn-italic" onclick="toggleItalic()"><i class="fa fa-italic"></i></button>
        <button class="align-btn" id="btn-underline" onclick="toggleUnderline()"><i class="fa fa-underline"></i></button>
      </div>

      <div class="sec-label">نص RTL</div>
      <div class="align-row">
        <button class="align-btn" onclick="setDirection('rtl')"><i class="fa fa-align-right"></i> عربي</button>
        <button class="align-btn" onclick="setDirection('ltr')"><i class="fa fa-align-left"></i> لاتيني</button>
      </div>

      <div class="sec-label">محاذاة على اللوحة</div>
      <div class="align-row">
        <button class="align-btn" onclick="alignOnCanvas('left')"><i class="fa fa-align-left"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('center-h')"><i class="fa fa-align-center"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('right')"><i class="fa fa-align-right"></i></button>
      </div>
      <div class="align-row">
        <button class="align-btn" onclick="alignOnCanvas('top')"><i class="fa fa-arrow-up"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('center-v')"><i class="fa fa-arrows-up-down"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('bottom')"><i class="fa fa-arrow-down"></i></button>
      </div>
    </div>

    <!-- Shape properties -->
    <div id="props-shape" style="display:none">
      <div class="sec-label">لون التعبئة</div>
      <div class="inp-row">
        <input type="color" id="prop-fill" onchange="setProp('fill', this.value)">
        <label style="font-size:11px;cursor:pointer">
          <input type="checkbox" id="prop-no-fill" onchange="toggleFill(this.checked)"> شفاف
        </label>
      </div>

      <div class="sec-label">الحدود</div>
      <div class="inp-row">
        <label>لون</label>
        <input type="color" id="prop-stroke" onchange="setProp('stroke', this.value)">
      </div>
      <div class="inp-row">
        <label>سُمك</label>
        <input type="number" class="inp-half" id="prop-stroke-w" min="0" max="50"
               oninput="setProp('strokeWidth', +this.value)">
      </div>

      <div class="sec-label">محاذاة</div>
      <div class="align-row">
        <button class="align-btn" onclick="alignOnCanvas('left')"><i class="fa fa-align-left"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('center-h')"><i class="fa fa-align-center"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('right')"><i class="fa fa-align-right"></i></button>
      </div>
      <div class="align-row">
        <button class="align-btn" onclick="alignOnCanvas('top')"><i class="fa fa-arrow-up"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('center-v')"><i class="fa fa-arrows-up-down"></i></button>
        <button class="align-btn" onclick="alignOnCanvas('bottom')"><i class="fa fa-arrow-down"></i></button>
      </div>
    </div>

    <!-- Image properties -->
    <div id="props-image" style="display:none">
      <div class="sec-label">الصورة</div>
      <div class="inp-row">
        <label>شفافية</label>
        <input type="range" min="0" max="1" step=".05" id="prop-opacity"
               oninput="setProp('opacity', +this.value)">
      </div>
      <button class="tb-btn danger" style="width:100%;margin-top:8px;justify-content:center"
              onclick="document.getElementById('img-upload').click()">
        <i class="fa fa-swap"></i> تغيير الصورة
      </button>
    </div>

    <!-- Nothing selected -->
    <div id="props-empty" style="color:var(--text-2);font-size:12px;text-align:center;padding-top:24px">
      <i class="fa fa-arrow-pointer" style="font-size:24px;margin-bottom:8px;display:block"></i>
      اختر عنصراً للتعديل
    </div>

    <!-- Common: opacity & position -->
    <div id="props-common" style="display:none;margin-top:16px;border-top:1px solid var(--border);padding-top:12px">
      <div class="sec-label">موضع وحجم</div>
      <div class="inp-row">
        <label>X</label><input type="number" class="inp-half" id="prop-x" oninput="setPropXY()">
        <label>Y</label><input type="number" class="inp-half" id="prop-y" oninput="setPropXY()">
      </div>
      <div class="inp-row">
        <label>عرض</label><input type="number" class="inp-half" id="prop-w" oninput="setPropWH()">
        <label>ارتفاع</label><input type="number" class="inp-half" id="prop-h" oninput="setPropWH()">
      </div>
      <div class="inp-row">
        <label>دوران</label>
        <input type="number" class="inp-half" id="prop-rot" min="-360" max="360"
               oninput="setProp('angle', +this.value)">
      </div>
      <div class="inp-row">
        <label>شفافية</label>
        <input type="range" min="0" max="1" step=".05" id="prop-op2"
               oninput="setProp('opacity', +this.value)">
      </div>
      <button class="tb-btn danger" style="width:100%;justify-content:center;margin-top:6px"
              onclick="deleteSelected()">
        <i class="fa fa-trash"></i> حذف
      </button>
    </div>
  </div>

</div><!-- .editor-body -->

<!-- Toast notification -->
<div class="toast" id="toast"></div>

<script>
/* ═══════════════════════════════════════════════
   FABRIC.JS DESIGN EDITOR — ايليت دعاية
   ═══════════════════════════════════════════════ */

let canvas;
let history = [], histIdx = -1;
const FONTS = ['Cairo','Tajawal','Arial','Georgia','Courier New','Impact'];

/* ──────────────────────────────
   Init
────────────────────────────── */
window.addEventListener('DOMContentLoaded', () => {
  canvas = new fabric.Canvas('main-canvas', {
    backgroundColor: '#ffffff',
    selection:        true,
    preserveObjectStacking: true,
  });

  setCanvasSize(800, 800);
  buildFontChips();
  bindCanvasEvents();
  saveHistory();

  // Check if a product_id was passed (from product page)
  const productId = {{ isset($productId) && $productId ? (int)$productId : 'null' }};
  if (productId) loadProductBackground(productId);

  // Restore auto-saved design
  const saved = localStorage.getItem('fanoon_design');
  if (saved) {
    try {
      canvas.loadFromJSON(saved, () => canvas.renderAll());
      showToast('تم استعادة التصميم الأخير');
    } catch(e) {}
  }
});

/* ──────────────────────────────
   Canvas size
────────────────────────────── */
function setCanvasSize(w, h) {
  canvas.setWidth(w);
  canvas.setHeight(h);
  const area = document.getElementById('canvas-area');
  const scaleX = (area.clientWidth  - 40) / w;
  const scaleY = (area.clientHeight - 40) / h;
  const scale  = Math.min(1, Math.min(scaleX, scaleY));
  const wrap = document.getElementById('canvas-wrap');
  wrap.style.transform = `scale(${scale})`;
  wrap.style.transformOrigin = 'center center';
  wrap.style.width  = w + 'px';
  wrap.style.height = h + 'px';
  canvas.renderAll();
}

function changeCanvasSize(val) {
  const [w, h] = val.split('x').map(Number);
  setCanvasSize(w, h);
}

window.addEventListener('resize', () => {
  const sel = document.querySelector('.size-select');
  if (sel) { const [w,h] = sel.value.split('x').map(Number); setCanvasSize(w,h); }
});

/* ──────────────────────────────
   Tools
────────────────────────────── */
function setTool(tool) {
  document.querySelectorAll('[id^="tool-"]').forEach(b => b.classList.remove('active'));
  const btn = document.getElementById('tool-' + tool);
  if (btn) btn.classList.add('active');
  canvas.isDrawingMode = (tool === 'draw');
}

/* ──────────────────────────────
   Add objects
────────────────────────────── */
function addText(text = 'اكتب هنا...', size = 24, weight = 'normal') {
  const obj = new fabric.IText(text, {
    right:          40, top: 40,
    fontFamily:     'Cairo',
    fontSize:       size,
    fontWeight:     weight,
    fill:           '#000000',
    textAlign:      'right',
    direction:      'rtl',
    originX:        'right',
    selectable:     true,
  });
  canvas.add(obj);
  canvas.setActiveObject(obj);
  canvas.renderAll();
  saveHistory();
}

function addRect() {
  const obj = new fabric.Rect({
    left: 100, top: 100, width: 200, height: 120,
    fill: '#10b46a', stroke: 'transparent', strokeWidth: 0,
    rx: 8, ry: 8,
  });
  canvas.add(obj);
  canvas.setActiveObject(obj);
  canvas.renderAll();
  saveHistory();
}

function addCircle() {
  const obj = new fabric.Circle({
    left: 150, top: 150, radius: 80,
    fill: '#4ecdc4', stroke: 'transparent', strokeWidth: 0,
  });
  canvas.add(obj);
  canvas.setActiveObject(obj);
  canvas.renderAll();
  saveHistory();
}

function addTriangle() {
  const obj = new fabric.Triangle({
    left: 120, top: 100, width: 160, height: 140,
    fill: '#ff6b6b', stroke: 'transparent', strokeWidth: 0,
  });
  canvas.add(obj);
  canvas.setActiveObject(obj);
  canvas.renderAll();
  saveHistory();
}

function addLine() {
  const obj = new fabric.Line([50, 50, 350, 50], {
    stroke: '#000000', strokeWidth: 3, selectable: true,
  });
  canvas.add(obj);
  canvas.setActiveObject(obj);
  canvas.renderAll();
  saveHistory();
}

function addStar() {
  const star = new fabric.Polygon(starPoints(6, 60, 30), {
    left: 150, top: 150, fill: '#ffeaa7', stroke: 'transparent', strokeWidth: 0,
  });
  canvas.add(star);
  canvas.setActiveObject(star);
  canvas.renderAll();
  saveHistory();
}

function starPoints(points, outer, inner) {
  const pts = [];
  for (let i = 0; i < points * 2; i++) {
    const angle = (Math.PI / points) * i - Math.PI / 2;
    const r     = i % 2 === 0 ? outer : inner;
    pts.push({ x: Math.cos(angle) * r, y: Math.sin(angle) * r });
  }
  return pts;
}

/* ──────────────────────────────
   Image upload
────────────────────────────── */
function triggerUpload() {
  document.getElementById('img-upload').click();
}

function uploadImage(event) {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    fabric.Image.fromURL(e.target.result, img => {
      img.scaleToWidth(Math.min(300, canvas.width / 2));
      img.set({ left: 80, top: 80 });
      canvas.add(img);
      canvas.setActiveObject(img);
      canvas.renderAll();
      saveHistory();
    });
  };
  reader.readAsDataURL(file);
  event.target.value = '';
}

/* ──────────────────────────────
   Background
────────────────────────────── */
function setBackground(color) {
  canvas.setBackgroundColor(color, () => canvas.renderAll());
  saveHistory();
}

/* ──────────────────────────────
   Properties panel
────────────────────────────── */
function bindCanvasEvents() {
  canvas.on('selection:created',  updateProps);
  canvas.on('selection:updated',  updateProps);
  canvas.on('selection:cleared',  clearProps);
  canvas.on('object:modified',    () => { updateProps(); saveHistory(); });
  canvas.on('object:added',       () => { refreshLayers(); saveHistory(); });
  canvas.on('object:removed',     () => { refreshLayers(); saveHistory(); });
}

function updateProps() {
  const obj = canvas.getActiveObject();
  if (!obj) { clearProps(); return; }

  // Show common
  document.getElementById('props-empty').style.display   = 'none';
  document.getElementById('props-common').style.display  = 'block';

  document.getElementById('prop-x').value   = Math.round(obj.left);
  document.getElementById('prop-y').value   = Math.round(obj.top);
  document.getElementById('prop-w').value   = Math.round(obj.getScaledWidth());
  document.getElementById('prop-h').value   = Math.round(obj.getScaledHeight());
  document.getElementById('prop-rot').value = Math.round(obj.angle || 0);
  document.getElementById('prop-op2').value = obj.opacity ?? 1;

  // Type-specific
  document.getElementById('props-text').style.display  = 'none';
  document.getElementById('props-shape').style.display = 'none';
  document.getElementById('props-image').style.display = 'none';

  if (obj.type === 'i-text' || obj.type === 'text') {
    document.getElementById('props-text').style.display  = 'block';
    document.getElementById('prop-fsize').value  = obj.fontSize || 16;
    document.getElementById('prop-fcolor').value = rgbToHex(obj.fill || '#000000');
    document.getElementById('btn-bold').classList.toggle('active', obj.fontWeight === 'bold');
    document.getElementById('btn-italic').classList.toggle('active', obj.fontStyle === 'italic');
    document.getElementById('btn-underline').classList.toggle('active', !!obj.underline);
    highlightFont(obj.fontFamily || 'Cairo');
  } else if (obj.type === 'image') {
    document.getElementById('props-image').style.display = 'block';
    document.getElementById('prop-opacity').value = obj.opacity ?? 1;
  } else {
    document.getElementById('props-shape').style.display = 'block';
    if (obj.fill && obj.fill !== 'transparent') {
      document.getElementById('prop-fill').value = rgbToHex(obj.fill);
      document.getElementById('prop-no-fill').checked = false;
    } else {
      document.getElementById('prop-no-fill').checked = true;
    }
    document.getElementById('prop-stroke').value   = rgbToHex(obj.stroke || '#000000');
    document.getElementById('prop-stroke-w').value = obj.strokeWidth || 0;
  }

  refreshLayers();
}

function clearProps() {
  document.getElementById('props-empty').style.display   = 'block';
  document.getElementById('props-common').style.display  = 'none';
  document.getElementById('props-text').style.display    = 'none';
  document.getElementById('props-shape').style.display   = 'none';
  document.getElementById('props-image').style.display   = 'none';
}

function setProp(prop, value) {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.set(prop, value);
  canvas.renderAll();
}

function setPropXY() {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.set({ left: +document.getElementById('prop-x').value, top: +document.getElementById('prop-y').value });
  obj.setCoords();
  canvas.renderAll();
}

function setPropWH() {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  const w = +document.getElementById('prop-w').value;
  const h = +document.getElementById('prop-h').value;
  obj.set({ scaleX: w / obj.width, scaleY: h / obj.height });
  obj.setCoords();
  canvas.renderAll();
}

function toggleFill(transparent) {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.set('fill', transparent ? 'transparent' : '#cccccc');
  canvas.renderAll();
}

function toggleBold() {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.set('fontWeight', obj.fontWeight === 'bold' ? 'normal' : 'bold');
  canvas.renderAll();
  document.getElementById('btn-bold').classList.toggle('active', obj.fontWeight === 'bold');
}

function toggleItalic() {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.set('fontStyle', obj.fontStyle === 'italic' ? 'normal' : 'italic');
  canvas.renderAll();
  document.getElementById('btn-italic').classList.toggle('active', obj.fontStyle === 'italic');
}

function toggleUnderline() {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.set('underline', !obj.underline);
  canvas.renderAll();
  document.getElementById('btn-underline').classList.toggle('active', !!obj.underline);
}

function setDirection(dir) {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.set({ direction: dir, textAlign: dir === 'rtl' ? 'right' : 'left' });
  canvas.renderAll();
}

function alignOnCanvas(pos) {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  const cw = canvas.width, ch = canvas.height;
  const ow = obj.getScaledWidth(), oh = obj.getScaledHeight();
  if (pos === 'left')     obj.set({ left: 0, originX: 'left' });
  if (pos === 'right')    obj.set({ left: cw - ow, originX: 'left' });
  if (pos === 'center-h') obj.set({ left: (cw - ow) / 2, originX: 'left' });
  if (pos === 'top')      obj.set({ top: 0, originY: 'top' });
  if (pos === 'bottom')   obj.set({ top: ch - oh, originY: 'top' });
  if (pos === 'center-v') obj.set({ top: (ch - oh) / 2, originY: 'top' });
  obj.setCoords();
  canvas.renderAll();
}

/* ──────────────────────────────
   Fonts
────────────────────────────── */
function buildFontChips() {
  const grid = document.getElementById('font-list');
  FONTS.forEach(f => {
    const chip = document.createElement('span');
    chip.className = 'font-chip';
    chip.textContent = f;
    chip.style.fontFamily = f;
    chip.onclick = () => {
      setProp('fontFamily', f);
      document.querySelectorAll('.font-chip').forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
    };
    grid.appendChild(chip);
  });
}

function highlightFont(fontFamily) {
  document.querySelectorAll('.font-chip').forEach(c => {
    c.classList.toggle('active', c.textContent === fontFamily);
  });
}

/* ──────────────────────────────
   Object actions
────────────────────────────── */
function deleteSelected() {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  if (obj.type === 'activeSelection') {
    obj.getObjects().forEach(o => canvas.remove(o));
    canvas.discardActiveObject();
  } else {
    canvas.remove(obj);
  }
  canvas.renderAll();
  saveHistory();
}

function cloneSelected() {
  const obj = canvas.getActiveObject();
  if (!obj) return;
  obj.clone(clone => {
    clone.set({ left: obj.left + 20, top: obj.top + 20 });
    canvas.add(clone);
    canvas.setActiveObject(clone);
    canvas.renderAll();
    saveHistory();
  });
}

function bringForward() {
  const obj = canvas.getActiveObject();
  if (obj) { canvas.bringForward(obj); canvas.renderAll(); }
}

function sendBackward() {
  const obj = canvas.getActiveObject();
  if (obj) { canvas.sendBackwards(obj); canvas.renderAll(); }
}

/* ──────────────────────────────
   History (undo/redo)
────────────────────────────── */
function saveHistory() {
  const json = JSON.stringify(canvas.toJSON());
  history = history.slice(0, histIdx + 1);
  history.push(json);
  histIdx = history.length - 1;
  // Auto-save to localStorage
  localStorage.setItem('fanoon_design', json);
  refreshLayers();
}

function undo() {
  if (histIdx <= 0) { showToast('لا يوجد تراجع إضافي'); return; }
  histIdx--;
  canvas.loadFromJSON(history[histIdx], () => canvas.renderAll());
}

function redo() {
  if (histIdx >= history.length - 1) { showToast('لا يوجد إعادة إضافية'); return; }
  histIdx++;
  canvas.loadFromJSON(history[histIdx], () => canvas.renderAll());
}

/* ──────────────────────────────
   Layers list
────────────────────────────── */
function refreshLayers() {
  const list = document.getElementById('layers-list');
  if (!list) return;
  const objs  = canvas.getObjects();
  const active = canvas.getActiveObject();
  list.innerHTML = [...objs].reverse().map((obj, ri) => {
    const i     = objs.length - 1 - ri;
    const isSel = obj === active;
    const icon  = obj.type === 'i-text' ? 'fa-font'
                : obj.type === 'image'  ? 'fa-image'
                : obj.type === 'line'   ? 'fa-minus'
                : 'fa-shapes';
    const name  = obj.type === 'i-text' ? (obj.text || '').slice(0, 18)
                : obj.type === 'image'  ? 'صورة'
                : obj.type;
    return `
    <div class="layer-item${isSel?' selected':''}" onclick="selectLayer(${i})">
      <span class="layer-ico"><i class="fa ${icon}"></i></span>
      <span class="layer-name">${name}</span>
      <span class="layer-actions">
        <button class="layer-action-btn" onclick="event.stopPropagation();canvas.remove(canvas.getObjects()[${i}]);canvas.renderAll();saveHistory()">
          <i class="fa fa-xmark"></i>
        </button>
      </span>
    </div>`;
  }).join('');
}

function selectLayer(index) {
  const obj = canvas.getObjects()[index];
  if (obj) { canvas.setActiveObject(obj); canvas.renderAll(); updateProps(); }
}

/* ──────────────────────────────
   Templates
────────────────────────────── */
const TEMPLATES = {
  tshirt: {
    bg: '#ffffff',
    objects: [
      { type: 'rect', left:200, top:180, width:400, height:440, fill:'#e8f0eb', rx:8, ry:8 },
      { type: 'text', text:'ايليت دعاية', left:400, top:280, fontFamily:'Cairo', fontSize:38, fontWeight:'bold', fill:'#10b46a', textAlign:'center', originX:'center', direction:'rtl' },
      { type: 'text', text:'نص فرعي هنا', left:400, top:340, fontFamily:'Cairo', fontSize:20, fill:'#4a5e50', textAlign:'center', originX:'center', direction:'rtl' },
    ],
  },
  mug: {
    bg: '#f5f0eb',
    objects: [
      { type: 'rect', left:100, top:80, width:600, height:240, fill:'#fff', rx:16, ry:16, stroke:'#d6e8d9', strokeWidth:2 },
      { type: 'text', text:'اسم الشخص', left:400, top:160, fontFamily:'Cairo', fontSize:44, fontWeight:'bold', fill:'#0f1512', textAlign:'center', originX:'center', direction:'rtl' },
      { type: 'text', text:'2024', left:400, top:220, fontFamily:'Cairo', fontSize:22, fill:'#8fa895', textAlign:'center', originX:'center' },
    ],
  },
  sticker: {
    bg: '#ffff00',
    objects: [
      { type: 'text', text:'ملصق تعريفي', left:400, top:320, fontFamily:'Cairo', fontSize:42, fontWeight:'bold', fill:'#000', textAlign:'center', originX:'center', direction:'rtl' },
    ],
  },
  banner: {
    bg: '#0f1512',
    objects: [
      { type: 'rect', left:0, top:0, width:800, height:80, fill:'#10b46a' },
      { type: 'text', text:'عرض خاص — خصم 30%', left:400, top:28, fontFamily:'Cairo', fontSize:34, fontWeight:'bold', fill:'#fff', textAlign:'center', originX:'center', direction:'rtl' },
      { type: 'text', text:'ايليت للدعاية والطباعة', left:400, top:120, fontFamily:'Cairo', fontSize:26, fill:'#8fa895', textAlign:'center', originX:'center', direction:'rtl' },
    ],
  },
  card: {
    bg: '#ffffff',
    objects: [
      { type: 'rect', left:0, top:0, width:800, height:800, fill:'#0f1512' },
      { type: 'rect', left:0, top:0, width:8, height:800, fill:'#10b46a' },
      { type: 'text', text:'ايليت دعاية', left:60, top:80, fontFamily:'Cairo', fontSize:44, fontWeight:'bold', fill:'#ffffff', direction:'rtl' },
      { type: 'text', text:'خبراء الطباعة والتصميم', left:60, top:150, fontFamily:'Cairo', fontSize:20, fill:'#8fa895', direction:'rtl' },
      { type: 'text', text:'📞 0599-123-456', left:60, top:560, fontFamily:'Cairo', fontSize:22, fill:'#10b46a', direction:'rtl' },
      { type: 'text', text:'🌐 elite-design.ps', left:60, top:610, fontFamily:'Cairo', fontSize:22, fill:'#8fa895', direction:'rtl' },
    ],
  },
  logo: {
    bg: '#ffffff',
    objects: [
      { type: 'text', text:'✦', left:400, top:240, fontFamily:'Cairo', fontSize:90, fill:'#10b46a', textAlign:'center', originX:'center' },
      { type: 'text', text:'ايليت', left:400, top:360, fontFamily:'Cairo', fontSize:64, fontWeight:'bold', fill:'#0f1512', textAlign:'center', originX:'center', direction:'rtl' },
      { type: 'text', text:'ELITE DESIGN', left:400, top:440, fontFamily:'Cairo', fontSize:20, fill:'#8fa895', textAlign:'center', originX:'center', letterSpacing:6 },
    ],
  },
};

function loadTemplate(name) {
  const tmpl = TEMPLATES[name];
  if (!tmpl) return;
  canvas.clear();
  canvas.setBackgroundColor(tmpl.bg, () => canvas.renderAll());
  tmpl.objects.forEach(spec => {
    const type = spec.type;
    const cfg  = Object.assign({}, spec);
    delete cfg.type;
    let obj;
    if (type === 'rect')    obj = new fabric.Rect(cfg);
    else if (type === 'text') obj = new fabric.IText(spec.text, cfg);
    if (obj) canvas.add(obj);
  });
  canvas.renderAll();
  saveHistory();
  showToast('تم تحميل القالب: ' + name);
}

/* ──────────────────────────────
   Export
────────────────────────────── */
function exportPNG() {
  canvas.discardActiveObject();
  canvas.renderAll();
  const url = canvas.toDataURL({ format: 'png', quality: 1, multiplier: 2 });
  const a   = document.createElement('a');
  a.href    = url;
  a.download = 'design-elite-' + Date.now() + '.png';
  a.click();
  showToast('تم التنزيل بنجاح ✓');
}

function saveJSON() {
  const json = JSON.stringify(canvas.toJSON(), null, 2);
  localStorage.setItem('fanoon_design', json);
  const a = document.createElement('a');
  a.href  = 'data:application/json;charset=utf-8,' + encodeURIComponent(json);
  a.download = 'design-elite-' + Date.now() + '.json';
  a.click();
  showToast('تم حفظ التصميم ✓');
}

/* ──────────────────────────────
   Side tabs
────────────────────────────── */
function switchSideTab(tab) {
  ['elements','templates','layers'].forEach(t => {
    document.getElementById('tab-' + t).style.display = t === tab ? '' : 'none';
  });
  document.querySelectorAll('.side-tab').forEach((el, i) => {
    el.classList.toggle('active', ['elements','templates','layers'][i] === tab);
  });
  if (tab === 'layers') refreshLayers();
}

/* ──────────────────────────────
   Keyboard shortcuts
────────────────────────────── */
document.addEventListener('keydown', e => {
  if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
  if ((e.ctrlKey || e.metaKey) && e.key === 'z') { e.preventDefault(); undo(); }
  if ((e.ctrlKey || e.metaKey) && e.key === 'y') { e.preventDefault(); redo(); }
  if (e.key === 'Delete' || e.key === 'Backspace') { e.preventDefault(); deleteSelected(); }
  if ((e.ctrlKey || e.metaKey) && e.key === 'd') { e.preventDefault(); cloneSelected(); }
});

/* ──────────────────────────────
   Toast
────────────────────────────── */
let toastTimer;
function showToast(msg) {
  const el = document.getElementById('toast');
  el.textContent = msg;
  el.style.display = 'block';
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => el.style.display = 'none', 2500);
}

/* ──────────────────────────────
   Helpers
────────────────────────────── */
function rgbToHex(color) {
  if (!color || color === 'transparent') return '#000000';
  if (color.startsWith('#')) return color.length === 4
    ? '#' + color[1]+color[1]+color[2]+color[2]+color[3]+color[3]
    : color;
  const m = color.match(/\d+/g);
  if (!m) return '#000000';
  return '#' + [m[0],m[1],m[2]].map(n => (+n).toString(16).padStart(2,'0')).join('');
}

function loadProductBackground(productId) {
  // يمكن تعديله لجلب صورة المنتج من الـ API وتعيينها خلفية
  showToast('محرر تصميم المنتج #' + productId);
}
</script>

</body>
</html>
