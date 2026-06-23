<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title id="page-title">تفاصيل المنتج — ايليت دعاية</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
  --red:#10b46a; --red-d:#0c8f52; --red-10:rgba(16,180,106,.10);
  --navy:#0f1512; --amber:#f59e0b;
  --surface:#f5f8f4; --white:#FFFFFF; --border:#d6e8d9;
  --text:#0f1512; --text-2:#4a5e50; --text-3:#8fa895;
  --r-sm:8px; --r-md:14px; --r-lg:22px;
  --sh-sm:0 2px 8px rgba(15,21,18,.07); --sh-md:0 6px 20px rgba(15,21,18,.11);
  --max-w:1260px; --font:'IBM Plex Sans Arabic','Cairo',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:var(--font);background:var(--surface);color:var(--text);direction:rtl;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
ul{list-style:none}
img{display:block;max-width:100%}
button{font-family:var(--font);cursor:pointer}
.wrap{max-width:var(--max-w);margin-inline:auto;padding-inline:20px}

/* TOPBAR */
.topbar{background:var(--navy);padding:7px 0;font-size:13px;color:#8CA0BE;display:none}
.topbar.visible{display:block}
.topbar-inner{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
.topbar-left{display:flex;gap:18px}
.topbar-left a{display:flex;align-items:center;gap:5px;color:#8CA0BE;transition:color .2s}
.topbar-left a:hover{color:#fff}
.topbar-left i{color:var(--amber);font-size:11px}
.topbar-right{display:flex;gap:14px}
.topbar-right a{color:#8CA0BE;font-size:12px;transition:color .2s}
.topbar-right a:hover{color:var(--amber)}

/* HEADER */
.header{background:var(--white);position:sticky;top:0;z-index:200;box-shadow:0 1px 0 var(--border)}
.header-body{display:flex;align-items:center;gap:20px;padding:12px 0}
.logo{display:flex;align-items:center;gap:10px;flex-shrink:0}
.logo-mark{width:120px;height:50px;background:#000;border:1.5px solid #222;border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden;padding:5px 10px;box-shadow:0 2px 8px rgba(15,21,18,.08)}
.logo-name{font-size:17px;font-weight:900;color:var(--navy);line-height:1.2}
.logo-tag{font-size:11px;color:var(--text-3);font-weight:500}
.search-wrap{flex:1;display:flex;align-items:center;background:#f5f8f4;border:1.5px solid var(--border);border-radius:12px;padding:0 12px;gap:10px;max-width:520px;transition:border-color .2s}
.search-wrap:focus-within{border-color:var(--red)}
.search-wrap input{flex:1;border:none;background:none;outline:none;font-family:var(--font);font-size:14px;color:var(--text);padding:10px 0}
.s-btn{background:var(--red);color:#fff;border:none;border-radius:9px;padding:7px 14px;font-size:13px;transition:background .2s;cursor:pointer}
.s-btn:hover{background:var(--red-d)}
.h-actions{display:flex;align-items:center;gap:10px;margin-inline-start:auto}
.wa-btn{display:flex;align-items:center;gap:7px;background:#25d366;color:#fff;padding:8px 16px;border-radius:10px;font-size:13px;font-weight:600;transition:background .2s}
.wa-btn:hover{background:#1aa84e}
.wa-btn .fab{font-size:16px}
.icon-btn{position:relative;width:42px;height:42px;display:flex;align-items:center;justify-content:center;border-radius:10px;background:#f5f8f4;border:1.5px solid var(--border);color:var(--text-2);font-size:16px;transition:all .2s;cursor:pointer}
.icon-btn:hover{background:var(--red-10);border-color:var(--red);color:var(--red)}
.badge{position:absolute;top:-5px;right:-5px;background:var(--red);color:#fff;width:18px;height:18px;border-radius:50%;font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center}
.badge.off{display:none}

/* BREADCRUMB */
.bc{background:var(--white);border-bottom:1px solid var(--border);padding:12px 0;font-size:13px;color:var(--text-3)}
.bc-inner{display:flex;align-items:center;gap:8px}
.bc-inner a{color:var(--text-3);transition:color .2s}
.bc-inner a:hover{color:var(--red)}
.bc-inner i{font-size:10px}

/* PRODUCT PAGE */
.prod-page{padding:40px 0 60px}
.prod-layout{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start}
.prod-gallery{position:sticky;top:80px}
.prod-main-img{width:100%;aspect-ratio:1;border-radius:var(--r-lg);overflow:hidden;background:linear-gradient(145deg,#134e2a,#1e7a43);display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.prod-main-img img{width:100%;height:100%;object-fit:cover}
.prod-main-icon{font-size:100px;color:rgba(16,180,106,.5)}
.prod-thumbs{display:flex;gap:10px;flex-wrap:wrap}
.thumb{width:72px;height:72px;border-radius:10px;overflow:hidden;cursor:pointer;border:2px solid transparent;transition:border-color .2s}
.thumb.active,.thumb:hover{border-color:var(--red)}
.thumb img{width:100%;height:100%;object-fit:cover}

/* PRODUCT INFO */
.prod-info{}
.prod-badge-row{display:flex;gap:8px;margin-bottom:14px;flex-wrap:wrap}
.badge-cat{display:inline-flex;align-items:center;gap:5px;background:var(--red-10);color:var(--red);padding:5px 12px;border-radius:50px;font-size:12px;font-weight:600}
.badge-disc{background:var(--amber);color:var(--navy);padding:5px 12px;border-radius:50px;font-size:12px;font-weight:700}
.prod-name{font-size:26px;font-weight:800;color:var(--navy);line-height:1.4;margin-bottom:10px}
.prod-stars{display:flex;align-items:center;gap:8px;margin-bottom:18px;font-size:14px;color:var(--text-2)}
.stars-gold{color:#f59e0b;font-size:15px;letter-spacing:1px}
.prod-price-row{display:flex;align-items:baseline;gap:12px;margin-bottom:22px}
.price-now{font-size:32px;font-weight:900;color:var(--red)}
.price-was{font-size:18px;color:var(--text-3);text-decoration:line-through}
.price-unit{font-size:13px;color:var(--text-3);margin-top:4px}
.prod-desc{font-size:15px;color:var(--text-2);line-height:1.85;margin-bottom:24px}
.divider{height:1px;background:var(--border);margin:20px 0}

/* QTY & ACTION */
.qty-row{display:flex;align-items:center;gap:16px;margin-bottom:22px}
.qty-label{font-size:14px;font-weight:600;color:var(--text-2)}
.qty-ctrl{display:flex;align-items:center;border:1.5px solid var(--border);border-radius:10px;overflow:hidden}
.qty-btn{width:38px;height:38px;display:flex;align-items:center;justify-content:center;background:#f5f8f4;border:none;font-size:16px;font-weight:700;color:var(--text);cursor:pointer;transition:background .2s}
.qty-btn:hover{background:var(--red-10);color:var(--red)}
.qty-val{width:48px;text-align:center;font-size:16px;font-weight:700;color:var(--navy);border:none;outline:none;background:var(--white)}
.btn-add-cart{flex:1;background:var(--red);color:#fff;border:none;border-radius:12px;padding:14px 28px;font-size:15px;font-weight:700;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s;cursor:pointer}
.btn-add-cart:hover{background:var(--red-d)}
.btn-wish{width:50px;height:50px;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--border);border-radius:12px;background:var(--white);color:var(--text-2);font-size:18px;cursor:pointer;transition:all .2s;flex-shrink:0}
.btn-wish:hover,.btn-wish.active{background:var(--red-10);border-color:var(--red);color:var(--red)}

/* INFO TABLE */
.info-table{width:100%;border-collapse:collapse;font-size:14px}
.info-table tr:nth-child(even){background:var(--surface)}
.info-table td{padding:9px 14px;border:1px solid var(--border)}
.info-table td:first-child{font-weight:600;color:var(--text-2);width:40%}

/* RELATED */
.related-sec{padding:50px 0}
.sec-title{font-size:20px;font-weight:800;color:var(--navy);margin-bottom:24px}
.prod-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.prod-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--r-md);overflow:hidden;transition:box-shadow .2s,transform .2s}
.prod-card:hover{box-shadow:var(--sh-md);transform:translateY(-3px)}
.prod-img-wrap{position:relative;aspect-ratio:1;overflow:hidden}
.prod-actions{position:absolute;bottom:10px;left:50%;transform:translateX(-50%) translateY(10px);display:flex;gap:8px;opacity:0;transition:all .25s}
.prod-card:hover .prod-actions{opacity:1;transform:translateX(-50%) translateY(0)}
.pa-btn{background:rgba(255,255,255,.95);border:none;border-radius:8px;padding:7px 12px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:5px;cursor:pointer;color:var(--navy);backdrop-filter:blur(4px);white-space:nowrap}
.pa-btn:hover{background:var(--red);color:#fff}
.pa-wish{padding:7px 9px}
.badge-sale{position:absolute;top:10px;right:10px;background:var(--amber);color:var(--navy);padding:3px 8px;border-radius:6px;font-size:11px;font-weight:700}
.prod-body{padding:14px}
.prod-name{font-size:14px;font-weight:600;color:var(--navy);margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.prod-name a{color:inherit}
.prod-price{display:flex;align-items:baseline;gap:8px}
.price-sm{font-size:15px;font-weight:800;color:var(--red)}
.price-sm-was{font-size:12px;color:var(--text-3);text-decoration:line-through}

/* SKELETON */
.skel{background:linear-gradient(90deg,#e8f0ea 25%,#d4e8d8 50%,#e8f0ea 75%);background-size:200% 100%;animation:shimmer 1.4s infinite}
@keyframes shimmer{0%{background-position:200% 0}100%{background-position:-200% 0}}

/* CART */
.cart-veil{position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:500;opacity:0;pointer-events:none;transition:opacity .3s}
.cart-veil.on{opacity:1;pointer-events:all}
.cart-drawer{position:fixed;top:0;right:-420px;width:420px;height:100%;background:#fff;z-index:501;box-shadow:var(--sh-md);transition:right .3s;display:flex;flex-direction:column}
.cart-drawer.on{right:0}
.cart-hd{display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid var(--border);font-weight:700;font-size:16px}
.cart-x{background:none;border:none;font-size:20px;cursor:pointer;color:var(--text-2)}
.cart-bd{flex:1;overflow-y:auto;padding:12px 20px}
.cart-ft{padding:16px 20px;border-top:1px solid var(--border)}
.cart-total-row{display:flex;justify-content:space-between;font-size:15px;font-weight:700;margin-bottom:14px}
.cart-item{display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid var(--border)}
.cart-item-img{width:52px;height:52px;border-radius:8px;background:var(--surface);overflow:hidden;flex-shrink:0}
.cart-item-img img{width:100%;height:100%;object-fit:cover}
.cart-item-name{font-size:13px;font-weight:600;color:var(--navy)}
.cart-item-price{font-size:12px;color:var(--text-2);margin-top:2px}
.cart-item-del{margin-inline-start:auto;background:none;border:none;color:var(--text-3);cursor:pointer;font-size:16px}
.cart-item-del:hover{color:#e74c3c}
.cart-empty-msg{display:flex;flex-direction:column;align-items:center;gap:14px;padding:50px 0;color:var(--text-3);text-align:center}
.cart-empty-msg i{font-size:48px}
.btn-red{display:inline-flex;align-items:center;gap:8px;background:var(--red);color:#fff;padding:11px 22px;border-radius:12px;font-size:14px;font-weight:700;transition:background .2s;cursor:pointer;border:none}
.btn-red:hover{background:var(--red-d)}

/* DESIGN BUTTON */
.btn-design{
  flex:1;background:#fff;color:var(--red);border:2px solid var(--red);
  border-radius:12px;padding:14px 28px;font-size:15px;font-weight:700;
  display:flex;align-items:center;justify-content:center;gap:8px;
  transition:all .2s;cursor:pointer
}
.btn-design:hover{background:var(--red-10)}

/* DESIGN MODAL */
.design-veil{
  position:fixed;inset:0;background:rgba(0,0,0,.75);z-index:600;
  display:none;align-items:center;justify-content:center
}
.design-veil.on{display:flex}
.design-modal{
  background:#1a1f1c;border-radius:20px;overflow:hidden;
  width:min(98vw,1200px);height:min(96vh,800px);
  display:flex;flex-direction:column;
  box-shadow:0 20px 60px rgba(0,0,0,.6)
}
.dm-header{
  background:#22282a;border-bottom:1px solid #3a4540;
  padding:12px 20px;display:flex;align-items:center;gap:12px;flex-shrink:0
}
.dm-title{font-size:16px;font-weight:800;color:#e8f0eb;font-family:'Cairo',sans-serif}
.dm-close{
  margin-inline-start:auto;background:none;border:none;
  color:#8fa895;font-size:20px;cursor:pointer;padding:4px 8px;
  border-radius:8px;transition:all .15s
}
.dm-close:hover{background:rgba(255,255,255,.1);color:#fff}
.dm-body{flex:1;overflow:hidden;display:flex}

/* Toolbar inside modal */
.dm-tools{
  background:#22282a;border-inline-end:1px solid #3a4540;
  width:56px;display:flex;flex-direction:column;align-items:center;
  padding:12px 0;gap:6px;flex-shrink:0
}
.dm-tool-btn{
  width:40px;height:40px;border-radius:8px;background:transparent;
  border:1px solid transparent;color:#8fa895;cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  font-size:14px;transition:all .15s;flex-shrink:0
}
.dm-tool-btn:hover{background:#2a3230;border-color:#3a4540;color:#e8f0eb}
.dm-tool-btn.act{background:rgba(16,180,106,.15);border-color:#10b46a;color:#10b46a}
.dm-tool-btn title{display:none}
.dm-sep{width:32px;height:1px;background:#3a4540;margin:4px 0}

/* Canvas area inside modal */
.dm-canvas-area{
  flex:1;display:flex;align-items:center;justify-content:center;
  background:#0f1512;overflow:hidden;position:relative
}
.dm-canvas-area::before{
  content:'';position:absolute;inset:0;
  background-image:radial-gradient(circle,#1e2e26 1px,transparent 1px);
  background-size:22px 22px;pointer-events:none
}
#dm-canvas-wrap{position:relative;z-index:1;
  box-shadow:0 6px 30px rgba(0,0,0,.5)}
#dm-canvas{display:block}

/* Right props */
.dm-props{
  background:#22282a;border-inline-start:1px solid #3a4540;
  width:200px;display:flex;flex-direction:column;padding:12px;
  gap:8px;overflow-y:auto;flex-shrink:0;font-family:'Cairo',sans-serif
}
.dm-sec{font-size:11px;font-weight:700;color:#8fa895;
  text-transform:uppercase;letter-spacing:.5px;margin-top:8px}
.dm-inp{
  background:#1a1f1c;border:1px solid #3a4540;border-radius:7px;
  color:#e8f0eb;font-family:'Cairo',sans-serif;font-size:12px;
  padding:6px 10px;outline:none;width:100%
}
.dm-inp:focus{border-color:#10b46a}
.dm-inp-row{display:flex;align-items:center;gap:6px}
.dm-inp-row label{font-size:11px;color:#8fa895;flex-shrink:0;min-width:36px}
input[type="color"].dm-color{
  width:34px;height:28px;padding:2px;border-radius:6px;
  cursor:pointer;background:#1a1f1c;border:1px solid #3a4540
}
.dm-align-row{display:flex;gap:3px}
.dm-align-btn{
  flex:1;padding:6px;border-radius:6px;background:#1a1f1c;
  border:1px solid #3a4540;color:#8fa895;cursor:pointer;
  font-size:12px;text-align:center;transition:all .12s
}
.dm-align-btn:hover{background:rgba(16,180,106,.1);border-color:#10b46a;color:#10b46a}

/* Footer with add-to-cart */
.dm-footer{
  background:#22282a;border-top:1px solid #3a4540;
  padding:14px 20px;display:flex;align-items:center;
  gap:12px;flex-shrink:0
}
.dm-hint{font-size:12px;color:#8fa895;flex:1;font-family:'Cairo',sans-serif}
.dm-btn{
  display:inline-flex;align-items:center;gap:7px;padding:10px 20px;
  border-radius:10px;font-family:'Cairo',sans-serif;font-size:14px;
  font-weight:700;cursor:pointer;border:none;transition:all .15s
}
.dm-btn.secondary{background:#2a3230;color:#e8f0eb;border:1px solid #3a4540}
.dm-btn.secondary:hover{background:#3a4540}
.dm-btn.primary{background:#10b46a;color:#fff}
.dm-btn.primary:hover{background:#0c8f52}
.dm-btn.primary:disabled{opacity:.6;cursor:not-allowed}

/* Cart design thumbnail */
.cart-design-thumb{
  width:36px;height:36px;border-radius:6px;object-fit:cover;
  border:1.5px solid var(--red);margin-inline-start:8px;cursor:pointer;
  flex-shrink:0
}
.design-badge{
  display:inline-flex;align-items:center;gap:4px;background:rgba(16,180,106,.12);
  border:1px solid var(--red);color:var(--red);padding:2px 8px;border-radius:20px;
  font-size:11px;font-weight:700;margin-top:3px
}

/* TOASTS */
.toasts{position:fixed;top:20px;left:50%;transform:translateX(-50%);z-index:1000;display:flex;flex-direction:column;gap:8px;pointer-events:none}
.toast{background:var(--navy);color:#fff;padding:10px 22px;border-radius:10px;font-size:14px;font-weight:500;display:flex;align-items:center;gap:8px;box-shadow:var(--sh-md);animation:slide-in .3s ease}
.toast.err{background:#e74c3c}
@keyframes slide-in{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:none}}

@media(max-width:900px){
  .prod-layout{grid-template-columns:1fr}
  .prod-gallery{position:static}
  .prod-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:600px){
  .prod-grid{grid-template-columns:repeat(2,1fr)}
  .header-body{flex-wrap:wrap;gap:10px}
  .search-wrap{order:3;max-width:100%}
  .cart-drawer{width:100%;right:-100%}
  .prod-name{font-size:20px}
}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar" id="topbar">
  <div class="wrap">
    <div class="topbar-inner">
      <div class="topbar-left" id="tb-contact"></div>
      <div class="topbar-right">
        <a href="/storefront/orders/track"><i class="fa fa-location-dot"></i> تتبع الطلب</a>
      </div>
    </div>
  </div>
</div>

<!-- HEADER -->
<header class="header">
  <div class="wrap">
    <div class="header-body">
      <a href="/" class="logo">
        <div class="logo-mark" id="logo-mark">ع</div>
        <div>
          <div class="logo-name" id="store-name">ايليت دعاية</div>
          <div class="logo-tag">طباعة وتصميم</div>
        </div>
      </a>
      <div class="search-wrap">
        <input id="search-q" type="text" placeholder="ابحث عن منتج...">
        <button class="s-btn" onclick="doSearch()"><i class="fa fa-search"></i></button>
      </div>
      <div class="h-actions">
        <a class="wa-btn" id="wa-btn" href="#" style="display:none">
          <i class="fab fa-whatsapp"></i> واتساب
        </a>
        <button class="icon-btn" onclick="openCart()">
          <i class="fa fa-bag-shopping"></i>
          <span class="badge off" id="cart-badge">0</span>
        </button>
      </div>
    </div>
  </div>
</header>

<!-- BREADCRUMB -->
<div class="bc">
  <div class="wrap">
    <div class="bc-inner">
      <a href="/"><i class="fa fa-house"></i> الرئيسية</a>
      <i class="fa fa-chevron-left"></i>
      <a href="/storefront/products">المنتجات</a>
      <i class="fa fa-chevron-left"></i>
      <span id="bc-name">تفاصيل المنتج</span>
    </div>
  </div>
</div>

<!-- PRODUCT PAGE -->
<div class="prod-page" id="prod-page">
  <div class="wrap">
    <!-- SKELETON -->
    <div id="prod-skel" style="display:grid;grid-template-columns:1fr 1fr;gap:48px">
      <div class="skel" style="aspect-ratio:1;border-radius:22px"></div>
      <div style="display:flex;flex-direction:column;gap:16px;padding-top:10px">
        <div class="skel" style="height:32px;border-radius:8px;width:60%"></div>
        <div class="skel" style="height:50px;border-radius:8px"></div>
        <div class="skel" style="height:24px;border-radius:8px;width:40%"></div>
        <div class="skel" style="height:80px;border-radius:8px"></div>
        <div class="skel" style="height:52px;border-radius:12px"></div>
      </div>
    </div>

    <!-- REAL CONTENT -->
    <div class="prod-layout" id="prod-content" style="display:none">
      <!-- GALLERY -->
      <div class="prod-gallery">
        <div class="prod-main-img" id="main-img">
          <i class="fa fa-box-open prod-main-icon" id="main-icon"></i>
        </div>
        <div class="prod-thumbs" id="thumbs"></div>
      </div>

      <!-- INFO -->
      <div class="prod-info">
        <div class="prod-badge-row" id="badge-row"></div>
        <h1 class="prod-name" id="prod-name">جاري التحميل...</h1>
        <div class="prod-stars" id="prod-stars"></div>
        <div class="prod-price-row">
          <span class="price-now" id="price-now">—</span>
          <span class="price-was" id="price-was" style="display:none"></span>
        </div>
        <p class="prod-desc" id="prod-desc"></p>
        <div class="divider"></div>
        <!-- QTY -->
        <div class="qty-row">
          <span class="qty-label">الكمية:</span>
          <div class="qty-ctrl">
            <button class="qty-btn" onclick="changeQty(-1)">−</button>
            <input type="number" class="qty-val" id="qty" value="1" min="1" max="99">
            <button class="qty-btn" onclick="changeQty(1)">+</button>
          </div>
        </div>
        <div style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap">
          <button class="btn-design" id="btn-design" onclick="openDesignEditor()">
            <i class="fa fa-palette"></i> صمم منتجك
          </button>
          <button class="btn-add-cart" id="btn-cart" onclick="addProdToCart()">
            <i class="fa fa-cart-plus"></i> أضف للسلة
          </button>
          <button class="btn-wish" id="btn-wish" onclick="toggleWishThis()" title="أضف للمفضلة">
            <i class="fa fa-heart"></i>
          </button>
        </div>
        <div class="divider"></div>
        <!-- INFO TABLE -->
        <table class="info-table" id="info-table" style="display:none">
          <tbody id="info-tbody"></tbody>
        </table>
      </div>
    </div>

    <!-- NOT FOUND -->
    <div id="prod-notfound" style="display:none;text-align:center;padding:80px 0;color:var(--text-3)">
      <i class="fa fa-box-open" style="font-size:56px;margin-bottom:18px"></i>
      <p style="font-size:18px;font-weight:600">المنتج غير موجود</p>
      <a href="/storefront/products" class="btn-red" style="margin-top:20px">← تصفح المنتجات</a>
    </div>
  </div>
</div>

<!-- RELATED PRODUCTS -->
<div class="related-sec" id="related-sec" style="display:none">
  <div class="wrap">
    <h2 class="sec-title">منتجات مشابهة</h2>
    <div class="prod-grid" id="related-grid"></div>
  </div>
</div>

<!-- CART -->
<div class="cart-veil" id="cart-veil" onclick="closeCart()"></div>
<div class="cart-drawer" id="cart-drawer">
  <div class="cart-hd">
    <span>🛒 سلة التسوق</span>
    <button class="cart-x" onclick="closeCart()"><i class="fa fa-xmark"></i></button>
  </div>
  <div class="cart-bd" id="cart-bd"></div>
  <div class="cart-ft" id="cart-ft" style="display:none">
    <div class="cart-total-row"><span>المجموع:</span><span id="cart-tot">0 ₪</span></div>
    <a href="/storefront/checkout" class="btn-red" style="width:100%;justify-content:center;display:flex">
      <i class="fa fa-credit-card"></i> إتمام الشراء
    </a>
  </div>
</div>

<!-- ════════════════════════════════════
     DESIGN EDITOR MODAL
════════════════════════════════════ -->
<div class="design-veil" id="design-veil">
  <div class="design-modal">

    <!-- Header -->
    <div class="dm-header">
      <i class="fa fa-palette" style="color:#10b46a;font-size:18px"></i>
      <span class="dm-title">محرر التصميم</span>
      <span id="dm-prod-label" style="font-size:12px;color:#8fa895;font-family:'Cairo',sans-serif"></span>
      <button class="dm-close" onclick="closeDesignEditor()"><i class="fa fa-xmark"></i></button>
    </div>

    <!-- Body -->
    <div class="dm-body">

      <!-- Vertical tools -->
      <div class="dm-tools">
        <button class="dm-tool-btn act" id="dm-sel" onclick="dmTool('select')" title="اختيار"><i class="fa fa-arrow-pointer"></i></button>
        <div class="dm-sep"></div>
        <button class="dm-tool-btn" onclick="dmAddText()" title="نص"><i class="fa fa-font"></i></button>
        <button class="dm-tool-btn" onclick="dmAddRect()" title="مستطيل"><i class="fa fa-square"></i></button>
        <button class="dm-tool-btn" onclick="dmAddCircle()" title="دائرة"><i class="fa fa-circle"></i></button>
        <button class="dm-tool-btn" onclick="dmAddLine()" title="خط"><i class="fa fa-minus"></i></button>
        <div class="dm-sep"></div>
        <button class="dm-tool-btn" onclick="document.getElementById('dm-img-in').click()" title="رفع صورة"><i class="fa fa-image"></i></button>
        <input type="file" id="dm-img-in" accept="image/*" style="display:none" onchange="dmUploadImg(event)">
        <div class="dm-sep"></div>
        <button class="dm-tool-btn" onclick="dmUndo()" title="تراجع"><i class="fa fa-rotate-left"></i></button>
        <button class="dm-tool-btn" onclick="dmRedo()" title="إعادة"><i class="fa fa-rotate-right"></i></button>
        <div class="dm-sep"></div>
        <button class="dm-tool-btn" onclick="dmDelete()" title="حذف"><i class="fa fa-trash" style="color:#e74c3c"></i></button>
      </div>

      <!-- Canvas -->
      <div class="dm-canvas-area" id="dm-canvas-area">
        <div id="dm-canvas-wrap">
          <canvas id="dm-canvas"></canvas>
        </div>
      </div>

      <!-- Properties -->
      <div class="dm-props" id="dm-props">
        <div style="font-size:12px;color:#8fa895;text-align:center;padding:16px 0" id="dm-no-sel">
          <i class="fa fa-arrow-pointer" style="font-size:22px;margin-bottom:6px;display:block"></i>
          اختر عنصراً
        </div>

        <!-- Text props -->
        <div id="dm-text-props" style="display:none">
          <div class="dm-sec">النص</div>
          <div class="dm-inp-row" style="margin-bottom:6px">
            <label>حجم</label>
            <input type="number" class="dm-inp" id="dp-fsize" min="8" max="200" oninput="dmSet('fontSize',+this.value)">
          </div>
          <div class="dm-inp-row" style="margin-bottom:8px">
            <label>لون</label>
            <input type="color" class="dm-color" id="dp-fcolor" onchange="dmSet('fill',this.value)">
          </div>
          <div class="dm-align-row" style="margin-bottom:6px">
            <button class="dm-align-btn" onclick="dmSet('fontWeight',dmC()?.fontWeight==='bold'?'normal':'bold')"><i class="fa fa-bold"></i></button>
            <button class="dm-align-btn" onclick="dmSet('fontStyle',dmC()?.fontStyle==='italic'?'normal':'italic')"><i class="fa fa-italic"></i></button>
          </div>
          <div class="dm-align-row">
            <button class="dm-align-btn" onclick="dmSet('textAlign','right')"><i class="fa fa-align-right"></i></button>
            <button class="dm-align-btn" onclick="dmSet('textAlign','center')"><i class="fa fa-align-center"></i></button>
            <button class="dm-align-btn" onclick="dmSet('textAlign','left')"><i class="fa fa-align-left"></i></button>
          </div>
        </div>

        <!-- Shape/Image props -->
        <div id="dm-shape-props" style="display:none">
          <div class="dm-sec">التعبئة</div>
          <div class="dm-inp-row" style="margin-bottom:8px">
            <label>لون</label>
            <input type="color" class="dm-color" id="dp-fill" onchange="dmSet('fill',this.value)">
          </div>
          <div class="dm-sec">الحدود</div>
          <div class="dm-inp-row" style="margin-bottom:6px">
            <label>لون</label>
            <input type="color" class="dm-color" id="dp-stroke" onchange="dmSet('stroke',this.value)">
          </div>
          <div class="dm-inp-row">
            <label>سُمك</label>
            <input type="number" class="dm-inp" id="dp-strokew" min="0" max="30" oninput="dmSet('strokeWidth',+this.value)">
          </div>
        </div>

        <!-- Common -->
        <div id="dm-common-props" style="display:none">
          <div class="dm-sec">شفافية</div>
          <input type="range" min="0" max="1" step=".05" id="dp-opacity"
                 oninput="dmSet('opacity',+this.value)" style="width:100%;accent-color:#10b46a;margin-bottom:8px">
          <div class="dm-sec">محاذاة</div>
          <div class="dm-align-row" style="margin-bottom:4px">
            <button class="dm-align-btn" onclick="dmAlign('left')"><i class="fa fa-align-left"></i></button>
            <button class="dm-align-btn" onclick="dmAlign('center-h')"><i class="fa fa-align-center"></i></button>
            <button class="dm-align-btn" onclick="dmAlign('right')"><i class="fa fa-align-right"></i></button>
          </div>
          <div class="dm-align-row">
            <button class="dm-align-btn" onclick="dmAlign('top')"><i class="fa fa-arrow-up"></i></button>
            <button class="dm-align-btn" onclick="dmAlign('center-v')"><i class="fa fa-arrows-up-down"></i></button>
            <button class="dm-align-btn" onclick="dmAlign('bottom')"><i class="fa fa-arrow-down"></i></button>
          </div>
        </div>

        <!-- Background -->
        <div class="dm-sec" style="margin-top:12px">خلفية</div>
        <div style="display:flex;flex-wrap:wrap;gap:5px">
          @foreach(['#ffffff','#000000','#f5f0eb','#0f1512','#10b46a','#1e40af','#dc2626','#fbbf24'] as $c)
          <div style="width:24px;height:24px;background:{{ $c }};border-radius:5px;cursor:pointer;border:2px solid rgba(255,255,255,.15)"
               onclick="dmSetBg('{{ $c }}')"></div>
          @endforeach
          <label style="width:24px;height:24px;border-radius:5px;overflow:hidden;cursor:pointer;border:2px solid rgba(255,255,255,.15)">
            <input type="color" style="width:32px;height:32px;margin:-4px;border:none;cursor:pointer" onchange="dmSetBg(this.value)">
          </label>
        </div>
      </div>

    </div><!-- .dm-body -->

    <!-- Footer -->
    <div class="dm-footer">
      <div class="dm-hint">
        <i class="fa fa-lightbulb" style="color:#f59e0b"></i>
        أضف نصاً أو صورة على المنتج ثم اضغط "أضف للسلة مع التصميم"
      </div>
      <button class="dm-btn secondary" onclick="closeDesignEditor()">إلغاء</button>
      <button class="dm-btn secondary" onclick="dmClearDesign()"><i class="fa fa-eraser"></i> مسح</button>
      <button class="dm-btn primary" id="dm-add-cart-btn" onclick="dmAddToCart()">
        <i class="fa fa-cart-plus"></i> أضف للسلة مع التصميم
      </button>
    </div>

  </div><!-- .design-modal -->
</div><!-- .design-veil -->

<!-- Fabric.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>

<div class="toasts" id="toasts"></div>

<script>
const API = window.location.origin + '/api/v1';
const PROD_ID = {{ $productId ?? 0 }};
let CUR = '₪';
let _prod = null;
let _pBase = '';

// CART
let cart = JSON.parse(localStorage.getItem('f_cart')||'[]');
function renderCart() {
  const badge=document.getElementById('cart-badge'), bd=document.getElementById('cart-bd'), ft=document.getElementById('cart-ft'), tot=document.getElementById('cart-tot');
  badge.textContent = cart.reduce((s,i)=>s+i.qty,0);
  badge.classList.toggle('off', cart.length===0);
  if(!cart.length){ bd.innerHTML=`<div class="cart-empty-msg"><i class="fa fa-cart-shopping"></i><p>السلة فارغة</p></div>`; ft.style.display='none'; return; }
  bd.innerHTML = cart.map(i=>`<div class="cart-item"><div class="cart-item-img">${i.img?`<img src="${i.img}" onerror="this.remove()">`:'<i class="fa fa-box" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#aaa"></i>'}</div><div><div class="cart-item-name">${i.name}</div><div class="cart-item-price">${i.qty} × ${parseFloat(i.price).toFixed(2)} ${CUR}</div></div><button class="cart-item-del" onclick="removeFromCart(${i.id})"><i class="fa fa-xmark"></i></button></div>`).join('');
  tot.textContent = cart.reduce((s,i)=>s+i.qty*parseFloat(i.price),0).toFixed(2)+' '+CUR;
  ft.style.display='block';
}
function removeFromCart(id){ cart=cart.filter(i=>i.id!==id); localStorage.setItem('f_cart',JSON.stringify(cart)); renderCart(); }
function openCart(){ document.getElementById('cart-veil').classList.add('on'); document.getElementById('cart-drawer').classList.add('on'); }
function closeCart(){ document.getElementById('cart-veil').classList.remove('on'); document.getElementById('cart-drawer').classList.remove('on'); }
function toast(msg,type='ok'){ const tc=document.getElementById('toasts'),t=document.createElement('div'); t.className=`toast ${type}`; t.textContent=msg; tc.appendChild(t); setTimeout(()=>t.remove(),3000); }
function doSearch(){ const q=document.getElementById('search-q').value.trim(); if(q) location.href=`/storefront/products?q=${encodeURIComponent(q)}`; }
document.getElementById('search-q').addEventListener('keydown',e=>e.key==='Enter'&&doSearch());

// QTY
function changeQty(d){ const el=document.getElementById('qty'); let v=parseInt(el.value)+d; el.value=Math.max(1,Math.min(99,v)); }

// WISHLIST
function toggleWishThis(){
  if(!_prod) return;
  let wl=JSON.parse(localStorage.getItem('f_wl')||'[]');
  const i=wl.indexOf(_prod.id);
  if(i>-1){ wl.splice(i,1); toast('أُزيل من المفضلة','err'); document.getElementById('btn-wish').classList.remove('active'); }
  else { wl.push(_prod.id); toast('أُضيف للمفضلة ♥'); document.getElementById('btn-wish').classList.add('active'); }
  localStorage.setItem('f_wl',JSON.stringify(wl));
}

// ADD TO CART
function addProdToCart(){
  if(!_prod) return;
  const qty = parseInt(document.getElementById('qty').value)||1;
  const price = parseFloat(_prod.price||_prod.unit_price||0);
  const disc  = parseFloat(_prod.discount||0);
  const finalPrice = disc>0 ? price-price*disc/100 : price;
  const imgSrc = (_prod.image_fullpath&&Array.isArray(_prod.image_fullpath)&&_prod.image_fullpath[0]) ? _prod.image_fullpath[0] : '';
  const existing = cart.find(i=>i.id===_prod.id);
  if(existing){ existing.qty+=qty; } else { cart.push({id:_prod.id,name:_prod.name,price:finalPrice,qty,img:imgSrc}); }
  localStorage.setItem('f_cart',JSON.stringify(cart));
  renderCart();
  toast(`أُضيف للسلة: ${_prod.name}`);
  openCart();
}

// PROD STYLE
const prodIconMap = [
  [['درع','دروع','كأس','كريستال','نحاس','ألومنيوم','خشب','زجاج','لوح'],['fa-trophy','linear-gradient(145deg,#134e2a,#1e7a43)','#10b46a']],
  [['لافت','شادر','رول','إكس','بانر','ستاند'],['fa-rectangle-ad','linear-gradient(145deg,#1e3a5f,#2563eb)','#60a5fa']],
  [['بطاقة','كارت','هوية','تعريف'],['fa-id-card','linear-gradient(145deg,#4c1d95,#7c3aed)','#a78bfa']],
  [['كيس','حقيبة','ظرف'],['fa-bag-shopping','linear-gradient(145deg,#7c2d12,#ea580c)','#fb923c']],
  [['كوب','مج','ماگ'],['fa-mug-hot','linear-gradient(145deg,#1e3a5f,#0ea5e9)','#38bdf8']],
  [['قميص','تيشرت','ملابس'],['fa-shirt','linear-gradient(145deg,#064e3b,#10b981)','#34d399']],
  [['قلم','طقم','أقلام'],['fa-pen','linear-gradient(145deg,#1e1b4b,#4338ca)','#818cf8']],
  [['هدية','توزيعة','مفاجأة'],['fa-gift','linear-gradient(145deg,#831843,#db2777)','#f472b6']],
];
function getProdStyle(name=''){
  for(const [kws,[icon,grad,accent]] of prodIconMap)
    for(const kw of kws) if(name.includes(kw)) return {icon,grad,accent};
  return {icon:'fa-print',grad:'linear-gradient(145deg,#134e2a,#1e7a43)',accent:'#10b46a'};
}

// MAIN
async function init(){
  // Config
  let cfg={};
  try{
    cfg = await fetch(`${API}/config`).then(r=>r.json());
    const name=cfg.ecommerce_name||cfg.business_name||'ايليت دعاية';
    if(cfg.currency_symbol) CUR=cfg.currency_symbol;
    document.getElementById('store-name').textContent=name;
    _pBase = cfg.base_urls?.product_image_url||'';
    const logoUrl=cfg.logo_full_url||'';
    if(logoUrl){ document.getElementById('logo-mark').innerHTML=`<img src="${logoUrl}" alt="${name}" style="width:100%;height:100%;object-fit:contain">`; }
    const ph=cfg.ecommerce_phone||cfg.phone||'';
    if(ph){ document.getElementById('tb-contact').innerHTML+=`<a href="tel:${ph}"><i class="fa fa-phone"></i>${ph}</a>`; document.getElementById('topbar').classList.add('visible'); }
    const em=cfg.ecommerce_email||cfg.email||'';
    if(em){ document.getElementById('tb-contact').innerHTML+=`<a href="mailto:${em}"><i class="fa fa-envelope"></i>${em}</a>`; document.getElementById('topbar').classList.add('visible'); }
    if(cfg.whatsapp?.status&&cfg.whatsapp?.number){ const wa=`https://wa.me/${cfg.whatsapp.number}`; const btn=document.getElementById('wa-btn'); btn.href=wa; btn.style.display='flex'; }
  }catch(e){}

  if(!PROD_ID){ showNotFound(); return; }

  try{
    const raw  = await fetch(`${API}/products/details/${PROD_ID}`).then(r=>r.json());
    const data = raw?.product ?? raw;          // API wraps in {product:{...}}
    if(!data||data.errors||!data.id){ showNotFound(); return; }
    _prod = data;
    renderProduct(data);

    // Load related
    if(data.category_ids&&data.category_ids.length){
      const catId = Array.isArray(data.category_ids[0]) ? data.category_ids[0] : (data.category_ids[0]?.id||data.category_ids[0]);
      fetch(`${API}/categories/products/${catId}?limit=8`).then(r=>r.json()).then(rd=>{
        const list = (Array.isArray(rd)?rd:(rd.products||[])).filter(p=>p.id!==PROD_ID).slice(0,4);
        if(list.length){
          document.getElementById('related-sec').style.display='block';
          document.getElementById('related-grid').innerHTML = list.map(p=>relCard(p)).join('');
        }
      }).catch(()=>{});
    }
  }catch(e){
    showNotFound();
  }
}

function showNotFound(){
  document.getElementById('prod-skel').style.display='none';
  document.getElementById('prod-notfound').style.display='block';
}

function renderProduct(p){
  document.getElementById('prod-skel').style.display='none';
  document.getElementById('prod-content').style.display='grid';

  const st = getProdStyle(p.name||'');

  // Page title + breadcrumb
  document.title = `${p.name} — ايليت دعاية`;
  document.getElementById('page-title').textContent = p.name + ' — ايليت دعاية';
  document.getElementById('bc-name').textContent = p.name;

  // Badges
  const discPct = parseFloat(p.discount||0);
  const badgeRow = document.getElementById('badge-row');
  if(p.category_name) badgeRow.innerHTML += `<span class="badge-cat"><i class="fa fa-tag"></i>${p.category_name}</span>`;
  if(discPct>0) badgeRow.innerHTML += `<span class="badge-disc">خصم ${Math.round(discPct)}%</span>`;

  // Name
  document.getElementById('prod-name').textContent = p.name||'';

  // Stars
  const rating = (Array.isArray(p.rating)&&p.rating.length)
    ? p.rating.reduce((s,r)=>s+parseFloat(r.rating||0),0)/p.rating.length
    : 4.2;
  const rNum = Math.round(rating);
  const reviewCount = Array.isArray(p.reviews)?p.reviews.length:(Math.floor(Math.random()*30+5));
  document.getElementById('prod-stars').innerHTML =
    `<span class="stars-gold">${'★'.repeat(Math.min(rNum,5))}${'☆'.repeat(Math.max(0,5-rNum))}</span> ${rating.toFixed(1)} (${reviewCount} تقييم)`;

  // Price
  const price  = parseFloat(p.price||p.unit_price||0);
  const finalP = discPct>0 ? price-price*discPct/100 : price;
  document.getElementById('price-now').textContent = `${finalP.toFixed(2)} ${CUR}`;
  if(discPct>0){
    const pw = document.getElementById('price-was');
    pw.textContent = `${price.toFixed(2)} ${CUR}`;
    pw.style.display='';
  }

  // Description
  const descEl = document.getElementById('prod-desc');
  if(p.description){ descEl.innerHTML = p.description; }
  else { descEl.style.display='none'; }

  // Main image
  const imgs = Array.isArray(p.image_fullpath)?p.image_fullpath:(p.image_fullpath?[p.image_fullpath]:[]);
  const realImgs = imgs.filter(u=>u&&!u.includes('img2.jpg'));
  const mainImgEl = document.getElementById('main-img');
  mainImgEl.style.background = st.grad;
  if(realImgs.length){
    document.getElementById('main-icon').style.display='none';
    mainImgEl.innerHTML = `<img src="${realImgs[0]}" alt="${p.name}" style="width:100%;height:100%;object-fit:cover" onerror="this.remove()">`;
    if(realImgs.length>1){
      const thumbs = document.getElementById('thumbs');
      realImgs.slice(0,5).forEach((url,i)=>{
        const t=document.createElement('div');
        t.className='thumb'+(i===0?' active':'');
        t.innerHTML=`<img src="${url}" alt="" loading="lazy">`;
        t.onclick=()=>{ mainImgEl.innerHTML=`<img src="${url}" alt="${p.name}" style="width:100%;height:100%;object-fit:cover">`; document.querySelectorAll('.thumb').forEach(x=>x.classList.remove('active')); t.classList.add('active'); };
        thumbs.appendChild(t);
      });
    }
  } else {
    document.getElementById('main-icon').className = `fa ${st.icon} prod-main-icon`;
    document.getElementById('main-icon').style.color = st.accent;
    document.getElementById('main-icon').style.opacity = '0.5';
  }

  // Info table
  const rows = [];
  if(p.unit)         rows.push(['الوحدة', p.unit]);
  if(p.capacity)     rows.push(['الحجم/الكمية', p.capacity]);
  if(p.set_menu)     rows.push(['عدد القطع', p.set_menu]);
  if(p.branch_name)  rows.push(['الفرع', p.branch_name]);
  if(rows.length){
    document.getElementById('info-table').style.display='table';
    document.getElementById('info-tbody').innerHTML = rows.map(([k,v])=>`<tr><td>${k}</td><td>${v}</td></tr>`).join('');
  }

  // Wishlist state
  const wl=JSON.parse(localStorage.getItem('f_wl')||'[]');
  if(wl.includes(p.id)) document.getElementById('btn-wish').classList.add('active');
}

function relCard(p){
  const st=getProdStyle(p.name||'');
  const imgs=Array.isArray(p.image_fullpath)?p.image_fullpath:(p.image_fullpath?[p.image_fullpath]:[]);
  const imgSrc=imgs.find(u=>u&&!u.includes('img2.jpg'))||null;
  const price=parseFloat(p.price||p.unit_price||0);
  const disc=parseFloat(p.discount||0);
  const now=disc>0?price-price*disc/100:price;
  const safeName=(p.name||'').replace(/'/g,"\\'");
  return `<div class="prod-card">
    <a href="/storefront/product/${p.id}">
      <div class="prod-img-wrap" style="background:${st.grad}">
        ${imgSrc?`<img src="${imgSrc}" alt="${p.name}" loading="lazy" style="width:100%;height:100%;object-fit:cover" onerror="this.remove()">`:''}
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none">
          <i class="fa ${st.icon}" style="font-size:48px;color:${st.accent};opacity:.45"></i>
        </div>
        ${disc>0?`<span class="badge-sale">-${Math.round(disc)}%</span>`:''}
        <div class="prod-actions">
          <button class="pa-btn pa-cart" onclick="event.preventDefault();relAdd(${p.id},'${safeName}',${now.toFixed(2)},'${imgSrc||''}')"><i class="fa fa-cart-plus"></i> سلة</button>
        </div>
      </div>
    </a>
    <div class="prod-body">
      <div class="prod-name"><a href="/storefront/product/${p.id}">${p.name||''}</a></div>
      <div class="prod-price">
        <span class="price-sm">${now.toFixed(2)} ${CUR}</span>
        ${disc>0?`<span class="price-sm-was">${price.toFixed(2)} ${CUR}</span>`:''}
      </div>
    </div>
  </div>`;
}

function relAdd(id,name,price,img){
  const ex=cart.find(i=>i.id===id);
  if(ex){ex.qty++;}else{cart.push({id,name,price,qty:1,img});}
  localStorage.setItem('f_cart',JSON.stringify(cart));
  renderCart(); toast('أُضيف للسلة: '+name); openCart();
}

renderCart();
init();

/* ═══════════════════════════════════════════
   DESIGN EDITOR
═══════════════════════════════════════════ */
let dm = null;           // Fabric canvas
let dmHistory = [], dmHistIdx = -1;
let dmProductImgUrl = '';

// ── فتح وإغلاق ──
function openDesignEditor() {
  if (!_prod) return;
  const veil = document.getElementById('design-veil');
  veil.classList.add('on');
  document.body.style.overflow = 'hidden';
  setTimeout(() => { initDmCanvas(); }, 50);
  document.getElementById('dm-prod-label').textContent = _prod.name || '';
}

function closeDesignEditor() {
  document.getElementById('design-veil').classList.remove('on');
  document.body.style.overflow = '';
}

// ── تهيئة canvas ──
function initDmCanvas() {
  if (dm) { dm.dispose(); dm = null; }

  // حجم canvas بناءً على حاوية الـ modal
  const area = document.getElementById('dm-canvas-area');
  const maxW  = area.clientWidth  - 40;
  const maxH  = area.clientHeight - 40;
  const side  = Math.min(maxW, maxH, 600);

  dm = new fabric.Canvas('dm-canvas', {
    width: side, height: side,
    backgroundColor: '#ffffff',
    preserveObjectStacking: true,
  });

  const wrap = document.getElementById('dm-canvas-wrap');
  wrap.style.width  = side + 'px';
  wrap.style.height = side + 'px';

  // نضع صورة المنتج كطبقة شبه شفافة (ghost) في الخلفية
  const imgs = Array.isArray(_prod.image_fullpath) ? _prod.image_fullpath : (_prod.image_fullpath ? [_prod.image_fullpath] : []);
  const realImg = imgs.find(u => u && !u.includes('img2.jpg'));
  if (realImg) {
    dmProductImgUrl = realImg;
    fabric.Image.fromURL(realImg, img => {
      // مقياس يناسب الـ canvas
      const scaleX = (side * 0.85) / img.width;
      const scaleY = (side * 0.85) / img.height;
      const scale  = Math.min(scaleX, scaleY);
      img.set({
        left: side / 2, top: side / 2,
        originX: 'center', originY: 'center',
        scaleX: scale, scaleY: scale,
        opacity: 0.25,
        selectable: false, evented: false,
        excludeFromExport: true,  // لا تُصدَّر مع التصميم النهائي
        isProductGhost: true,
      });
      dm.add(img);
      dm.sendToBack(img);
      dm.renderAll();
    }, { crossOrigin: 'anonymous' });
  }

  dm.on('selection:created',  dmUpdateProps);
  dm.on('selection:updated',  dmUpdateProps);
  dm.on('selection:cleared',  dmClearProps);
  dm.on('object:modified',    () => { dmUpdateProps(); dmSaveHistory(); });

  dmSaveHistory();
  dmHistIdx = 0; dmHistory = [JSON.stringify(dm.toJSON())];
}

// ── أدوات ──
function dmTool(t) {
  document.querySelectorAll('.dm-tool-btn').forEach(b => b.classList.remove('act'));
  if (t === 'select') document.getElementById('dm-sel').classList.add('act');
  dm.isDrawingMode = false;
}

function dmAddText(txt = 'اكتب هنا', size = 22) {
  if (!dm) return;
  const o = new fabric.IText(txt, {
    right: 30, top: 30, fontFamily: 'Cairo',
    fontSize: size, fill: '#000', textAlign: 'right',
    direction: 'rtl', originX: 'right',
  });
  dm.add(o); dm.setActiveObject(o); dm.renderAll(); dmSaveHistory();
}
function dmAddRect() {
  if (!dm) return;
  const o = new fabric.Rect({ left:60,top:60,width:160,height:100,fill:'#10b46a',rx:6,ry:6 });
  dm.add(o); dm.setActiveObject(o); dm.renderAll(); dmSaveHistory();
}
function dmAddCircle() {
  if (!dm) return;
  const o = new fabric.Circle({ left:80,top:80,radius:70,fill:'#4ecdc4' });
  dm.add(o); dm.setActiveObject(o); dm.renderAll(); dmSaveHistory();
}
function dmAddLine() {
  if (!dm) return;
  const o = new fabric.Line([30,30,250,30],{stroke:'#000',strokeWidth:3});
  dm.add(o); dm.setActiveObject(o); dm.renderAll(); dmSaveHistory();
}
function dmUploadImg(ev) {
  const f = ev.target.files[0]; if (!f) return;
  const r = new FileReader();
  r.onload = e => fabric.Image.fromURL(e.target.result, img => {
    img.scaleToWidth(Math.min(220, dm.width * 0.4));
    img.set({left:60, top:60});
    dm.add(img); dm.setActiveObject(img); dm.renderAll(); dmSaveHistory();
  });
  r.readAsDataURL(f);
  ev.target.value = '';
}

// ── خلفية ──
function dmSetBg(color) {
  if (!dm) return;
  dm.setBackgroundColor(color, () => dm.renderAll());
  dmSaveHistory();
}

// ── خصائص ──
function dmC() { return dm?.getActiveObject(); }

function dmSet(prop, val) {
  const o = dmC(); if (!o) return;
  o.set(prop, val); dm.renderAll();
}

function dmAlign(pos) {
  const o = dmC(); if (!o) return;
  const cw = dm.width, ch = dm.height;
  const ow = o.getScaledWidth(), oh = o.getScaledHeight();
  if (pos==='left')     o.set({left:0, originX:'left'});
  if (pos==='right')    o.set({left:cw-ow, originX:'left'});
  if (pos==='center-h') o.set({left:(cw-ow)/2, originX:'left'});
  if (pos==='top')      o.set({top:0, originY:'top'});
  if (pos==='bottom')   o.set({top:ch-oh, originY:'top'});
  if (pos==='center-v') o.set({top:(ch-oh)/2, originY:'top'});
  o.setCoords(); dm.renderAll();
}

function dmDelete() {
  const o = dmC(); if (!o || o.isProductGhost) return;
  if (o.type === 'activeSelection') { o.getObjects().forEach(x => !x.isProductGhost && dm.remove(x)); dm.discardActiveObject(); }
  else dm.remove(o);
  dm.renderAll(); dmSaveHistory();
}

function dmUpdateProps() {
  const o = dmC();
  document.getElementById('dm-no-sel').style.display = o ? 'none' : '';
  document.getElementById('dm-text-props').style.display = (o?.type==='i-text'||o?.type==='text') ? '' : 'none';
  document.getElementById('dm-shape-props').style.display = (o && o.type!=='i-text' && o.type!=='text') ? '' : 'none';
  document.getElementById('dm-common-props').style.display = o ? '' : 'none';
  if (!o) return;
  if (o.type==='i-text'||o.type==='text') {
    document.getElementById('dp-fsize').value  = o.fontSize || 22;
    document.getElementById('dp-fcolor').value = dmHex(o.fill||'#000');
  } else {
    document.getElementById('dp-fill').value   = dmHex(o.fill||'#10b46a');
    document.getElementById('dp-stroke').value = dmHex(o.stroke||'#000');
    document.getElementById('dp-strokew').value = o.strokeWidth || 0;
  }
  document.getElementById('dp-opacity').value = o.opacity ?? 1;
}

function dmClearProps() {
  document.getElementById('dm-no-sel').style.display = '';
  document.getElementById('dm-text-props').style.display = 'none';
  document.getElementById('dm-shape-props').style.display = 'none';
  document.getElementById('dm-common-props').style.display = 'none';
}

function dmHex(color) {
  if (!color || color==='transparent') return '#000000';
  if (color.startsWith('#')) return color.length===4
    ? '#'+color[1]+color[1]+color[2]+color[2]+color[3]+color[3] : color;
  const m = color.match(/\d+/g);
  if (!m) return '#000000';
  return '#'+[m[0],m[1],m[2]].map(n=>(+n).toString(16).padStart(2,'0')).join('');
}

// ── History ──
function dmSaveHistory() {
  if (!dm) return;
  // استبعاد صورة الـ ghost من التاريخ
  const objs = dm.getObjects().filter(o => !o.isProductGhost);
  const json  = JSON.stringify(dm.toJSON(['isProductGhost','excludeFromExport']));
  dmHistory = dmHistory.slice(0, dmHistIdx + 1);
  dmHistory.push(json);
  dmHistIdx = dmHistory.length - 1;
}
function dmUndo() {
  if (!dm || dmHistIdx <= 0) return;
  dmHistIdx--;
  dm.loadFromJSON(dmHistory[dmHistIdx], () => {
    dm.getObjects().forEach(o => { if (o.isProductGhost) { o.selectable=false; o.evented=false; } });
    dm.renderAll();
  });
}
function dmRedo() {
  if (!dm || dmHistIdx >= dmHistory.length-1) return;
  dmHistIdx++;
  dm.loadFromJSON(dmHistory[dmHistIdx], () => {
    dm.getObjects().forEach(o => { if (o.isProductGhost) { o.selectable=false; o.evented=false; } });
    dm.renderAll();
  });
}

// ── مسح التصميم ──
function dmClearDesign() {
  if (!dm) return;
  const ghosts = dm.getObjects().filter(o => o.isProductGhost);
  dm.clear();
  dm.setBackgroundColor('#ffffff', () => dm.renderAll());
  ghosts.forEach(g => dm.add(g));
  dm.renderAll();
  dmSaveHistory();
}

// ── أضف للسلة مع التصميم ──
async function dmAddToCart() {
  if (!dm || !_prod) return;

  const btn = document.getElementById('dm-add-cart-btn');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> جاري الحفظ...';

  try {
    // 1. إخفاء صورة الـ ghost مؤقتاً للتصدير
    const ghosts = dm.getObjects().filter(o => o.isProductGhost);
    ghosts.forEach(o => o.set('opacity', 0));
    dm.renderAll();

    // 2. تصدير canvas
    const dataUrl = dm.toDataURL({ format: 'png', quality: 0.92, multiplier: 2 });

    // 3. إعادة الـ ghost
    ghosts.forEach(o => o.set('opacity', 0.25));
    dm.renderAll();

    // 4. رفع الصورة للسيرفر
    const res = await fetch(`${API}/design/upload`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify({ image: dataUrl, product_id: _prod.id }),
    });

    if (!res.ok) throw new Error('فشل رفع التصميم');
    const { url: designUrl } = await res.json();

    // 5. أضف للسلة مع design_image + design_url
    const qty = parseInt(document.getElementById('qty').value) || 1;
    const price = parseFloat(_prod.price || _prod.unit_price || 0);
    const disc  = parseFloat(_prod.discount || 0);
    const finalPrice = disc > 0 ? price - price * disc / 100 : price;
    const imgSrc = (_prod.image_fullpath && Array.isArray(_prod.image_fullpath) && _prod.image_fullpath[0])
      ? _prod.image_fullpath[0] : '';

    const existing = cart.find(i => i.id === _prod.id && i.design_url === designUrl);
    if (existing) {
      existing.qty += qty;
    } else {
      cart.push({
        id:        _prod.id,
        name:      _prod.name,
        price:     finalPrice,
        qty:       qty,
        img:       imgSrc,
        design_url:    designUrl,    // رابط الصورة للعرض
        has_design: true,
      });
    }

    localStorage.setItem('f_cart', JSON.stringify(cart));
    renderCart();

    closeDesignEditor();
    toast('✓ أُضيف للسلة مع التصميم المخصص');
    openCart();

  } catch (err) {
    toast('خطأ: ' + (err.message || 'حدث خطأ غير متوقع'), 'err');
  } finally {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-cart-plus"></i> أضف للسلة مع التصميم';
  }
}

// ── تحديث renderCart لعرض صورة التصميم ──
// نُعيد تعريف renderCart لتشمل صورة التصميم
const _origRenderCart = renderCart;
renderCart = function() {
  const badge=document.getElementById('cart-badge');
  const bd=document.getElementById('cart-bd');
  const ft=document.getElementById('cart-ft');
  const tot=document.getElementById('cart-tot');
  badge.textContent = cart.reduce((s,i)=>s+i.qty,0);
  badge.classList.toggle('off', cart.length===0);
  if(!cart.length){
    bd.innerHTML=`<div class="cart-empty-msg"><i class="fa fa-cart-shopping"></i><p>السلة فارغة</p></div>`;
    ft.style.display='none'; return;
  }
  bd.innerHTML = cart.map(i=>`
    <div class="cart-item">
      <div class="cart-item-img">
        ${i.design_url
          ? `<img src="${i.design_url}" alt="تصميم" style="width:100%;height:100%;object-fit:cover" onclick="window.open('${i.design_url}','_blank')">`
          : (i.img ? `<img src="${i.img}" onerror="this.remove()">` : '<i class="fa fa-box" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#aaa;font-size:20px"></i>')
        }
      </div>
      <div style="flex:1">
        <div class="cart-item-name">${i.name}</div>
        <div class="cart-item-price">${i.qty} × ${parseFloat(i.price).toFixed(2)} ${CUR}</div>
        ${i.has_design ? '<span class="design-badge"><i class="fa fa-palette"></i> تصميم مخصص</span>' : ''}
      </div>
      <button class="cart-item-del" onclick="removeFromCart(${i.id},'${i.design_url||''}')"><i class="fa fa-xmark"></i></button>
    </div>`).join('');
  tot.textContent = cart.reduce((s,i)=>s+i.qty*parseFloat(i.price),0).toFixed(2)+' '+CUR;
  ft.style.display='block';
};

// removeFromCart يحتاج تحديث ليدعم نفس المنتج بتصاميم مختلفة
function removeFromCart(id, designUrl='') {
  if (designUrl) {
    cart = cart.filter(i => !(i.id===id && (i.design_url||'')===designUrl));
  } else {
    cart = cart.filter(i => i.id!==id);
  }
  localStorage.setItem('f_cart', JSON.stringify(cart));
  renderCart();
}

// keyboard shortcuts للمحرر
document.addEventListener('keydown', e => {
  if (!document.getElementById('design-veil').classList.contains('on')) return;
  if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
  if ((e.ctrlKey||e.metaKey) && e.key==='z') { e.preventDefault(); dmUndo(); }
  if ((e.ctrlKey||e.metaKey) && e.key==='y') { e.preventDefault(); dmRedo(); }
  if (e.key==='Escape') closeDesignEditor();
  if (e.key==='Delete'||e.key==='Backspace') { e.preventDefault(); dmDelete(); }
});
</script>
</body>
</html>
