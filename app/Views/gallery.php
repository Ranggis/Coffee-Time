<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Our Gallery - Coffee Time</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* === VARIABEL GLOBAL === */
:root {
  --dark: #1b0f12;
  --brown: #3a241c;
  --accent: #f5deb3;
  --header-height: 80px;
  --border: rgba(245, 222, 179, 0.2);
  --glass: rgba(255, 255, 255, 0.05);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Playfair Display', serif;
  background-color: var(--dark);
  color: var(--accent);
  overflow-x: hidden;
}

/* ================= HEADER (KONSISTEN) ================= */
header {
  position: fixed; top: 0; left: 0; width: 100%; height: var(--header-height);
  z-index: 100;
  background: linear-gradient(to bottom, rgba(27,15,18,0.95), rgba(27,15,18,0.8));
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center; transition: 0.3s;
}
header.scrolled { background: rgba(27,15,18,0.98); box-shadow: 0 4px 15px rgba(0,0,0,0.4); }
nav {
  width: 100%; max-width: 1400px; margin: auto; padding: 0 50px;
  display: flex; align-items: center; justify-content: space-between;
}
.brand { display: flex; align-items: center; gap: 10px; text-decoration: none; color: var(--accent); z-index: 102; }
.brand i { font-size: 22px; }
.brand span { font-family: 'Dancing Script', cursive; font-size: 28px; }

/* Hamburger (Desktop Hidden) */
.menu-toggle {
  display: none; font-size: 24px; cursor: pointer; color: var(--accent); z-index: 999;
  position: relative; width: 30px; height: 30px; text-align: center;
}

/* Menu Desktop */
.menu { display: flex; gap: 28px; list-style: none; font-size: 14px; }
.menu li a { text-decoration: none; color: var(--accent); opacity: .85; transition: .3s; position: relative; }
.menu li a::after { content: ""; position: absolute; left: 0; bottom: -4px; width: 0; height: 1px; background: var(--accent); transition: .3s; }
.menu li a:hover { opacity: 1; }
.menu li a:hover::after { width: 100%; }

/* Icons & Hamburger Wrapper */
.nav-right { display: flex; align-items: center; z-index: 102; }
.nav-icons { display: flex; align-items: center; gap: 18px; font-size: 15px; }
.nav-icons a { color: var(--accent); text-decoration: none; transition: .3s; }
.nav-icons a:hover { opacity: 1; transform: translateY(-2px); }
.user-name { font-size: 14px; font-weight: bold; margin-right: 5px; }

/* ================= GALLERY HERO ================= */
.gallery-hero {
  height: 50vh;
  background: linear-gradient(rgba(27,15,18,0.6), rgba(27,15,18,1)), url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=1600&q=80');
  background-size: cover; background-position: center; background-attachment: fixed;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; margin-top: var(--header-height);
}
.gallery-hero h1 {
  font-family: 'Dancing Script', cursive; font-size: 4rem; margin-bottom: 10px; text-shadow: 0 5px 15px rgba(0,0,0,0.5);
}
.gallery-hero p { font-size: 1.1rem; opacity: 0.9; letter-spacing: 1px; }

/* ================= GALLERY GRID ================= */
.gallery-section { padding: 80px 50px; max-width: 1400px; margin: auto; }

/* Filter Tabs */
.gallery-tabs {
  display: flex; justify-content: center; gap: 20px; margin-bottom: 50px; flex-wrap: wrap;
}
.tab-btn {
  padding: 8px 25px; background: transparent; border: 1px solid var(--border); color: var(--accent);
  border-radius: 50px; cursor: pointer; font-family: inherit; font-size: 0.9rem; transition: 0.3s;
}
.tab-btn:hover, .tab-btn.active { background: var(--accent); color: var(--dark); border-color: var(--accent); }

/* Grid System */
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}

.gallery-item {
  position: relative; overflow: hidden; border-radius: 15px; cursor: pointer; height: 300px;
  border: 1px solid var(--glass);
}

.gallery-item img {
  width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
}

.gallery-overlay {
  position: absolute; inset: 0; background: rgba(27, 15, 18, 0.7);
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  opacity: 0; transition: 0.4s;
}

.gallery-overlay i { font-size: 2rem; color: var(--accent); margin-bottom: 10px; transform: translateY(20px); transition: 0.4s; }
.gallery-overlay h3 { font-size: 1.2rem; color: #fff; transform: translateY(20px); transition: 0.4s; }

/* Hover Effects */
.gallery-item:hover img { transform: scale(1.1); }
.gallery-item:hover .gallery-overlay { opacity: 1; }
.gallery-item:hover .gallery-overlay i, 
.gallery-item:hover .gallery-overlay h3 { transform: translateY(0); }

/* ================= LIGHTBOX (POPUP) ================= */
.lightbox {
  position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.95); z-index: 9999;
  display: none; align-items: center; justify-content: center;
  flex-direction: column; opacity: 0; transition: opacity 0.3s;
}
.lightbox.show { display: flex; opacity: 1; }

.lightbox-img {
  max-width: 90%; max-height: 80vh; border-radius: 10px;
  box-shadow: 0 0 50px rgba(245, 222, 179, 0.2);
  transform: scale(0.8); transition: 0.3s;
}
.lightbox.show .lightbox-img { transform: scale(1); }

.lightbox-caption { margin-top: 15px; color: var(--accent); font-size: 1.2rem; letter-spacing: 1px; }

.close-lightbox {
  position: absolute; top: 30px; right: 30px; font-size: 40px; color: #fff; cursor: pointer; transition: 0.3s;
}
.close-lightbox:hover { color: var(--accent); transform: rotate(90deg); }

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
  nav { padding: 0 20px; }
  
  /* Mobile Header Logic */
  .menu-toggle { display: block; margin-left: auto; margin-right: 20px; }
  .user-name { display: none; }

  .menu {
    position: fixed; top: 0; right: 0; width: 70%; max-width: 300px; height: 100vh;
    background: #2a1815; flex-direction: column; justify-content: flex-start;
    padding-top: 100px; padding-left: 30px; gap: 30px; font-size: 18px;
    transform: translateX(100%); transition: 0.4s; box-shadow: -10px 0 30px rgba(0,0,0,0.5);
    z-index: 101; 
  }
  .menu.active { transform: translateX(0); }

  .menu-backdrop {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.6); z-index: 100; opacity: 0; pointer-events: none; transition: 0.3s;
  }
  .menu-backdrop.active { opacity: 1; pointer-events: all; }

  .gallery-hero h1 { font-size: 3rem; }
  .gallery-section { padding: 60px 20px; }
}
</style>
</head>
<body>

<!-- Backdrop Mobile Menu -->
<div class="menu-backdrop" id="menu-backdrop"></div>

<!-- HEADER -->
<header>
  <nav>
    <a href="<?= base_url('/') ?>" class="brand">
      <i class="fas fa-mug-hot"></i><span>Coffee Time</span>
    </a>

    <!-- Hamburger (Mobile Only) -->
    <div class="menu-toggle" id="menu-toggle"><i class="fas fa-bars"></i></div>

    <!-- Menu Links -->
    <ul class="menu" id="menu-list">
      <li><a href="<?= base_url('/') ?>">Home</a></li>
      <li><a href="<?= base_url('about') ?>">About</a></li>
      <li><a href="<?= base_url('menu') ?>">Menu</a></li>
      <li><a href="<?= base_url('products') ?>">Products</a></li>
      <li><a href="<?= base_url('gallery') ?>">Gallery</a></li>
      <li><a href="<?= base_url('blog') ?>">Blog</a></li>
      <li><a href="<?= base_url('contact') ?>">Contact</a></li>
    </ul>

    <!-- Icons -->
    <div class="nav-right">
      <div class="nav-icons">
        <a href="#"><i class="fas fa-search"></i></a>
        <a href="<?= base_url('menu') ?>"><i class="fas fa-shopping-cart"></i></a>
        <?php if(isset($is_logged_in) && $is_logged_in): ?>
            <span class="user-name">Hi, <?= esc($username) ?></span>
            <a href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt" style="color: #ff6b6b;"></i></a>
        <?php else: ?>
            <a href="<?= base_url('auth/login') ?>"><i class="fas fa-user"></i></a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>

<!-- HERO -->
<section class="gallery-hero">
  <h1>Captured Moments</h1>
  <p>The art of coffee, the warmth of the ambiance.</p>
</section>

<!-- GALLERY GRID -->
<section class="gallery-section">
  
  <!-- Tabs -->
  <div class="gallery-tabs">
    <button class="tab-btn active" onclick="filterGallery('all')">All</button>
    <button class="tab-btn" onclick="filterGallery('interior')">Interior</button>
    <button class="tab-btn" onclick="filterGallery('latte')">Latte Art</button>
    <button class="tab-btn" onclick="filterGallery('vibes')">Vibes</button>
  </div>

  <div class="gallery-grid">
    
    <!-- Item 1 -->
    <div class="gallery-item interior" onclick="openLightbox(this)">
      <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=600&q=80" alt="Cozy Interior">
      <div class="gallery-overlay">
        <i class="fas fa-search-plus"></i>
        <h3>Cozy Interior</h3>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="gallery-item latte" onclick="openLightbox(this)">
      <img src="https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=600&q=80" alt="Perfect Latte Art">
      <div class="gallery-overlay">
        <i class="fas fa-search-plus"></i>
        <h3>Latte Art</h3>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="gallery-item vibes" onclick="openLightbox(this)">
      <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=600&q=80" alt="Afternoon Vibes">
      <div class="gallery-overlay">
        <i class="fas fa-search-plus"></i>
        <h3>Afternoon Vibes</h3>
      </div>
    </div>

    <!-- Item 4 -->
    <div class="gallery-item interior" onclick="openLightbox(this)">
      <img src="https://images.unsplash.com/photo-1521017432531-fbd92d768814?auto=format&fit=crop&w=600&q=80" alt="Barista Station">
      <div class="gallery-overlay">
        <i class="fas fa-search-plus"></i>
        <h3>Barista Station</h3>
      </div>
    </div>

    <!-- Item 5 -->
    <div class="gallery-item latte" onclick="openLightbox(this)">
      <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=600&q=80" alt="Cappuccino">
      <div class="gallery-overlay">
        <i class="fas fa-search-plus"></i>
        <h3>Cappuccino</h3>
      </div>
    </div>

    <!-- Item 6 -->
    <div class="gallery-item vibes" onclick="openLightbox(this)">
      <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=600&q=80" alt="Coffee with Friends">
      <div class="gallery-overlay">
        <i class="fas fa-search-plus"></i>
        <h3>Coffee with Friends</h3>
      </div>
    </div>

  </div>
</section>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
  <span class="close-lightbox" onclick="closeLightbox(event)">&times;</span>
  <img src="" alt="" class="lightbox-img" id="lightbox-img">
  <p class="lightbox-caption" id="lightbox-caption"></p>
</div>

<!-- JAVASCRIPT -->
<script>
  /* --- HEADER LOGIC --- */
  window.addEventListener("scroll", () => {
    document.querySelector("header").classList.toggle("scrolled", window.scrollY > 20);
  });

  const menuToggle = document.getElementById('menu-toggle');
  const menuList = document.getElementById('menu-list');
  const backdrop = document.getElementById('menu-backdrop');
  const icon = menuToggle.querySelector('i');

  function toggleMenu() {
    const isActive = menuList.classList.toggle('active');
    backdrop.classList.toggle('active');
    if (isActive) {
      icon.classList.remove('fa-bars'); icon.classList.add('fa-times');
    } else {
      icon.classList.remove('fa-times'); icon.classList.add('fa-bars');
    }
  }
  menuToggle.addEventListener('click', toggleMenu);
  backdrop.addEventListener('click', toggleMenu);

  document.querySelectorAll('.menu li a').forEach(link => {
    link.addEventListener('click', () => { if(menuList.classList.contains('active')) toggleMenu(); });
  });

  /* --- GALLERY FILTER LOGIC --- */
  function filterGallery(category) {
    const items = document.querySelectorAll('.gallery-item');
    const buttons = document.querySelectorAll('.tab-btn');

    // Button Active State
    buttons.forEach(btn => {
      btn.classList.remove('active');
      if (btn.innerText.toLowerCase().includes(category) || (category === 'all' && btn.innerText === 'All')) {
        btn.classList.add('active');
      }
    });

    items.forEach(item => {
      if (category === 'all' || item.classList.contains(category)) {
        item.style.display = 'block';
        setTimeout(() => item.style.opacity = '1', 50);
      } else {
        item.style.display = 'none';
        item.style.opacity = '0';
      }
    });
  }

  /* --- LIGHTBOX LOGIC --- */
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  const lightboxCaption = document.getElementById('lightbox-caption');

  function openLightbox(element) {
    const img = element.querySelector('img');
    const caption = element.querySelector('h3').innerText;
    
    // Ganti src dengan resolusi tinggi (disini kita pakai src yg sama utk contoh)
    lightboxImg.src = img.src;
    lightboxCaption.innerText = caption;
    
    lightbox.classList.add('show');
    document.body.style.overflow = 'hidden'; // Matikan scroll body
  }

  function closeLightbox(e) {
    // Tutup jika klik close button atau background
    if (e.target !== lightboxImg && e.target !== lightboxCaption) {
      lightbox.classList.remove('show');
      document.body.style.overflow = 'auto'; // Hidupkan scroll body
    }
  }
</script>

</body>
</html>