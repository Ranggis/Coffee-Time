<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>The Journal - Coffee Time</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* === VARIABEL & RESET === */
:root {
  --dark: #0f0809;
  --brown: #3a241c;
  --accent: #f5deb3;
  --header-height: 80px;
  --border: rgba(245, 222, 179, 0.15);
  --glass: rgba(20, 10, 10, 0.85); 
  --text-muted: rgba(245, 222, 179, 0.6);
}

/* Kursor dikembalikan ke default */
* { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; }

body {
  font-family: 'Lato', sans-serif;
  background-color: var(--dark);
  color: var(--accent);
  overflow-x: hidden;
  position: relative;
}

/* Texture Background */
body::before {
  content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background-image: url("https://www.transparenttextures.com/patterns/stardust.png");
  opacity: 0.05; pointer-events: none; z-index: 0;
}

h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

/* === PROGRESS BAR === */
#progress-container {
  position: fixed; top: 0; left: 0; width: 100%; height: 3px; background: transparent; z-index: 200;
}
#progress-bar {
  height: 3px; background: var(--accent); width: 0%; transition: width 0.1s;
  box-shadow: 0 0 10px var(--accent);
}

/* ================= HEADER ================= */
header {
  position: fixed; top: 0; left: 0; width: 100%; height: var(--header-height);
  z-index: 100;
  background: linear-gradient(to bottom, rgba(15,8,9,0.95), rgba(15,8,9,0.8));
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center; transition: 0.4s;
  backdrop-filter: blur(10px);
}
header.scrolled { background: rgba(15,8,9,0.98); box-shadow: 0 10px 30px rgba(0,0,0,0.5); }

nav {
  width: 100%; max-width: 1400px; margin: auto; padding: 0 50px;
  display: flex; align-items: center; justify-content: space-between;
}

/* Logo */
.brand { display: flex; align-items: center; gap: 10px; text-decoration: none; color: var(--accent); z-index: 102; }
.brand i { font-size: 24px; }
.brand span { font-family: 'Dancing Script', cursive; font-size: 28px; letter-spacing: 1px; }

/* Hamburger (Mobile) */
.menu-toggle {
  display: none; font-size: 24px; cursor: pointer; color: var(--accent); z-index: 999;
  position: relative; width: 30px; height: 30px; text-align: center; transition: 0.3s;
}

/* === MENU LINK WITH HOVER ANIMATION (_) === */
.menu { display: flex; gap: 30px; list-style: none; font-size: 14px; letter-spacing: 0.5px; }

.menu li a {
  text-decoration: none; color: var(--accent); opacity: 0.7; transition: 0.3s;
  position: relative; padding-bottom: 5px;
}

/* Garis Bawah Animasi (Tetap dipertahankan) */
.menu li a::after {
  content: ""; position: absolute; left: 0; bottom: 0; width: 0%; height: 1px;
  background: var(--accent); transition: width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.menu li a:hover, .menu li a.active { opacity: 1; }
.menu li a:hover::after, .menu li a.active::after { width: 100%; }

/* Right Nav */
.nav-right { display: flex; align-items: center; z-index: 102; }
.nav-icons { display: flex; align-items: center; gap: 20px; font-size: 16px; }
.nav-icons a { color: var(--accent); text-decoration: none; transition: 0.3s; }
.nav-icons a:hover { opacity: 1; transform: translateY(-2px); color: #fff; }
.user-name { font-size: 14px; font-weight: 700; margin-right: 5px; }

/* ================= HERO SECTION ================= */
.blog-hero {
  height: 75vh; position: relative;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; overflow: hidden;
}
.blog-hero-bg {
  position: absolute; top: 0; left: 0; width: 100%; height: 100%;
  background: url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
  filter: brightness(0.4); transform: scale(1.1); z-index: -1;
  animation: bgZoom 20s infinite alternate;
}
@keyframes bgZoom { from { transform: scale(1.1); } to { transform: scale(1.2); } }

.hero-content { z-index: 2; padding: 0 20px; max-width: 900px; }
.hero-subtitle {
  font-size: 1rem; text-transform: uppercase; letter-spacing: 4px; color: var(--accent);
  margin-bottom: 20px; display: block;
}
.hero-title {
  font-family: 'Playfair Display', serif; font-size: 5rem; line-height: 1;
  margin-bottom: 20px; color: #fff; text-shadow: 0 10px 30px rgba(0,0,0,0.5);
}
.hero-desc {
  font-size: 1.2rem; opacity: 0.8; font-weight: 300; max-width: 600px; margin: auto; line-height: 1.6;
}

/* ================= CATEGORY BAR ================= */
.category-bar {
  display: flex; justify-content: center; gap: 15px; padding: 20px 0;
  background: rgba(15, 8, 9, 0.95); backdrop-filter: blur(10px);
  position: sticky; top: var(--header-height); z-index: 90;
  border-bottom: 1px solid var(--border); overflow-x: auto;
}
.cat-pill {
  padding: 8px 25px; border-radius: 50px; border: 1px solid var(--border);
  color: var(--text-muted); text-decoration: none; font-size: 0.85rem; 
  text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; white-space: nowrap;
}
.cat-pill:hover, .cat-pill.active {
  background: var(--accent); color: var(--dark); border-color: var(--accent);
}

/* ================= BLOG CONTAINER ================= */
.blog-container { max-width: 1200px; margin: auto; padding: 80px 50px 120px; position: relative; z-index: 2; }

/* FEATURED POST (MAGAZINE STYLE) */
.featured-post {
  display: grid; grid-template-columns: 1.2fr 1fr; align-items: center;
  margin-bottom: 100px; position: relative;
}
.fp-image-wrapper {
  position: relative; height: 500px; border-radius: 5px; overflow: hidden;
  box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}
.fp-image-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: 0.7s ease; }
.fp-image-wrapper:hover img { transform: scale(1.05); }

.fp-content-wrapper {
  background: rgba(20, 12, 14, 0.95); backdrop-filter: blur(20px);
  border: 1px solid var(--border); padding: 50px;
  margin-left: -80px; /* Overlapping effect Desktop */
  position: relative; z-index: 2; border-radius: 5px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.4);
}
.badge {
  font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent);
  border: 1px solid var(--accent); padding: 4px 12px; display: inline-block; margin-bottom: 20px;
}
.fp-title { font-size: 2.8rem; line-height: 1.1; margin-bottom: 20px; color: #fff; }
.fp-excerpt { font-size: 1rem; opacity: 0.8; line-height: 1.8; margin-bottom: 30px; font-weight: 300; }

.fp-footer {
  display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--border); padding-top: 20px;
}
.fp-author { display: flex; align-items: center; gap: 15px; }
.fp-author img { width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--accent); object-fit: cover; }

.btn-read-more {
  text-decoration: none; color: var(--accent); font-weight: bold; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;
  transition: 0.3s; position: relative;
}
.btn-read-more::after {
  content: ''; position: absolute; left: 0; bottom: -2px; width: 0; height: 1px; background: var(--accent); transition: 0.3s;
}
.btn-read-more:hover::after { width: 100%; }

/* GRID CARD */
.section-heading {
  font-family: 'Dancing Script'; font-size: 3rem; text-align: center; margin-bottom: 50px; color: var(--accent);
}

.blog-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; }

.blog-card {
  background: transparent; transition: 0.4s; display: flex; flex-direction: column;
}
.blog-card:hover .card-img img { transform: scale(1.1); }

.card-img {
  height: 240px; overflow: hidden; border-radius: 10px; position: relative; margin-bottom: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}
.card-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s ease; }
.card-date {
  position: absolute; top: 15px; left: 15px; background: var(--accent); color: var(--dark);
  padding: 5px 10px; font-weight: bold; font-size: 0.75rem; border-radius: 3px; text-transform: uppercase;
}

.card-info { padding: 0 5px; flex: 1; display: flex; flex-direction: column; }
.card-tags { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: block; }
.card-title { font-size: 1.6rem; margin-bottom: 15px; line-height: 1.3; color: #fff; transition: 0.3s; }
.blog-card:hover .card-title { color: var(--accent); }
.card-desc { font-size: 0.95rem; opacity: 0.7; line-height: 1.6; margin-bottom: 20px; }

.card-link {
  color: #fff; text-decoration: none; font-size: 0.85rem; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;
  display: inline-block; margin-top: auto; transition: 0.3s; position: relative;
}
.card-link:hover { color: var(--accent); }
.card-link::after { content:''; position:absolute; left:0; bottom:-2px; width:0; height:1px; background:var(--accent); transition:0.3s; }
.card-link:hover::after { width:100%; }

/* ================= FOOTER ================= */
footer {
  background: #0b0506; border-top: 1px solid var(--border); padding: 60px 50px 30px;
  position: relative; z-index: 2;
}
.footer-grid {
  max-width: 1200px; margin: auto; display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px;
}
.ft-about h3 { font-family: 'Dancing Script'; font-size: 2.5rem; margin-bottom: 20px; color: var(--accent); }
.ft-about p { opacity: 0.7; line-height: 1.8; margin-bottom: 20px; font-size: 0.9rem; }
.socials a {
  color: var(--accent); font-size: 1.2rem; margin-right: 15px; transition: 0.3s;
  display: inline-flex; width: 35px; height: 35px; border: 1px solid var(--border);
  align-items: center; justify-content: center; border-radius: 50%;
}
.socials a:hover { background: var(--accent); color: var(--dark); transform: translateY(-3px); }

.ft-links h4 { font-size: 1rem; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
.ft-links ul { list-style: none; }
.ft-links li { margin-bottom: 10px; }
.ft-links a { text-decoration: none; color: rgba(255,255,255,0.6); transition: 0.3s; font-size: 0.9rem; }
.ft-links a:hover { color: var(--accent); }

.footer-bottom {
  text-align: center; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px;
  font-size: 0.85rem; opacity: 0.5;
}

/* ================= RESPONSIVE (MOBILE) ================= */
@media (max-width: 900px) {
  nav { padding: 0 20px; }
  
  /* 1. Hamburger di kiri ikon */
  .menu-toggle { display: block; margin-left: auto; margin-right: 20px; }
  .user-name { display: none; }

  /* 2. Sidebar Menu */
  .menu {
    position: fixed; top: 0; right: 0; width: 75%; max-width: 300px; height: 100vh;
    background: #1a1012; flex-direction: column; justify-content: flex-start;
    padding: 100px 30px; gap: 30px; font-size: 18px;
    transform: translateX(100%); transition: 0.4s; box-shadow: -10px 0 40px rgba(0,0,0,0.5); z-index: 101; 
  }
  .menu.active { transform: translateX(0); }

  .menu-backdrop {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.8); z-index: 100; opacity: 0; pointer-events: none; transition: 0.3s;
  }
  .menu-backdrop.active { opacity: 1; pointer-events: all; }

  /* 3. Mobile Content Fixes */
  .blog-hero { height: 60vh; }
  .blog-hero h1 { font-size: 3rem; }
  .hero-title { font-size: 2.8rem; }
  .hero-desc { font-size: 1rem; }
  
  /* Featured Post Mobile */
  .featured-post { 
    display: flex; flex-direction: column; 
    border-radius: 15px; overflow: hidden; border: 1px solid var(--border);
    margin-bottom: 60px;
  }
  .fp-image-wrapper { height: 250px; width: 100%; border-radius: 0; box-shadow: none; }
  .fp-content-wrapper { 
    margin: 0; padding: 30px 20px; background: rgba(20, 12, 14, 0.95);
    border: none; border-top: 1px solid var(--border); border-radius: 0;
  }
  .fp-title { font-size: 1.8rem; }
  .fp-excerpt { font-size: 0.95rem; margin-bottom: 20px; }

  /* Footer Mobile */
  .footer-grid { grid-template-columns: 1fr; gap: 30px; text-align: left; }
  .category-bar { justify-content: flex-start; padding: 20px; }
  .blog-container { padding: 40px 20px; }
}
</style>
</head>
<body>

<!-- Progress Bar -->
<div id="progress-container"><div id="progress-bar"></div></div>

<!-- Backdrop -->
<div class="menu-backdrop" id="menu-backdrop"></div>

<!-- HEADER -->
<header>
  <nav>
    <a href="<?= base_url('/') ?>" class="brand">
      <i class="fas fa-mug-hot"></i><span>Coffee Time</span>
    </a>

    <!-- Hamburger (Mobile) -->
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
<section class="blog-hero">
  <div class="blog-hero-bg"></div>
  <div class="hero-content">
    <span class="hero-subtitle">The Journal</span>
    <h1 class="hero-title">Stories & Brews</h1>
    <p class="hero-desc">Dive deep into the culture behind the cup. From bean origins to barista techniques.</p>
  </div>
</section>

<!-- CATEGORY BAR -->
<div class="category-bar">
  <a href="#" class="cat-pill active">Latest</a>
  <a href="#" class="cat-pill">Brewing</a>
  <a href="#" class="cat-pill">Beans</a>
  <a href="#" class="cat-pill">Culture</a>
  <a href="#" class="cat-pill">Events</a>
</div>

<!-- CONTENT -->
<section class="blog-container">

  <!-- Featured Post -->
  <article class="featured-post">
    <div class="fp-image-wrapper">
      <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1200&q=80" alt="V60 Brewing">
    </div>
    <div class="fp-content-wrapper">
      <span class="badge">Editor's Pick</span>
      <h2 class="fp-title">Mastering the V60: A Guide to Clarity</h2>
      <p class="fp-excerpt">
        Mengapa teknik V60 begitu digemari? Kami membedah rahasia di balik kerucut sederhana ini yang mampu mengeluarkan notes buah dan bunga dari biji kopi favorit Anda.
      </p>
      <div class="fp-footer">
        <div class="fp-author">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Author">
          <div>
            <span style="display:block; font-size:0.9rem; font-weight:bold; color:#fff;">Ranggis</span>
            <span style="font-size:0.8rem; opacity:0.6;">Oct 12, 2025</span>
          </div>
        </div>
        <a href="#" class="btn-read-more">Read Article</a>
      </div>
    </div>
  </article>

  <h2 class="section-heading">Recent Stories</h2>

  <!-- Grid -->
  <div class="blog-grid">
    
    <!-- Post 1 -->
    <article class="blog-card">
      <div class="card-img">
        <span class="card-date">Sep 28</span>
        <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=600&q=80" alt="Latte Art">
      </div>
      <div class="card-info">
        <span class="card-tags">Art • Skills</span>
        <h3 class="card-title">The Philosophy of Latte Art</h3>
        <p class="card-desc">Seni melukis di atas kopi bukan sekadar estetika, tapi bukti tekstur susu (microfoam) yang sempurna.</p>
        <a href="#" class="card-link">Read Story</a>
      </div>
    </article>

    <!-- Post 2 -->
    <article class="blog-card">
      <div class="card-img">
        <span class="card-date">Sep 15</span>
        <img src="https://images.unsplash.com/photo-1611854779393-1b2ae9d97d02?auto=format&fit=crop&w=600&q=80" alt="Beans">
      </div>
      <div class="card-info">
        <span class="card-tags">Knowledge • Origin</span>
        <h3 class="card-title">Arabica vs Robusta: The Truth</h3>
        <p class="card-desc">Memahami perbedaan rasa, kadar kafein, dan tempat tumbuh dua raksasa dunia kopi ini.</p>
        <a href="#" class="card-link">Read Story</a>
      </div>
    </article>

    <!-- Post 3 -->
    <article class="blog-card">
      <div class="card-img">
        <span class="card-date">Aug 30</span>
        <img src="https://images.unsplash.com/photo-1442512595367-42732509d3a4?auto=format&fit=crop&w=600&q=80" alt="Vibes">
      </div>
      <div class="card-info">
        <span class="card-tags">Lifestyle</span>
        <h3 class="card-title">The Coffee Shop Effect</h3>
        <p class="card-desc">Mengapa kita sering merasa lebih produktif saat bekerja di tengah kebisingan mesin kopi di cafe?</p>
        <a href="#" class="card-link">Read Story</a>
      </div>
    </article>

  </div>

</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="ft-about">
      <h3>Coffee Time</h3>
      <p>Menyajikan cerita di setiap cangkir. Tempat di mana rasa, aroma, dan kehangatan bertemu.</p>
      <div class="socials">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>
    </div>
    
    <div class="ft-links">
      <h4>Discover</h4>
      <ul>
        <li><a href="#">Our Menu</a></li>
        <li><a href="#">Store Location</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Careers</a></li>
      </ul>
    </div>

    <div class="ft-links">
      <h4>Support</h4>
      <ul>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Shipping</a></li>
        <li><a href="#">Returns</a></li>
      </ul>
    </div>

    <div class="ft-links">
      <h4>Newsletter</h4>
      <p style="font-size:0.9rem; opacity:0.6; margin-bottom:15px;">Subscribe for latest updates.</p>
      <form onsubmit="event.preventDefault();" style="display:flex; border-bottom:1px solid #555;">
        <input type="email" placeholder="Email Address" style="background:none; border:none; color:#fff; padding:10px; width:100%; outline:none;">
        <button style="background:none; border:none; color:var(--accent); cursor:pointer;"><i class="fas fa-arrow-right"></i></button>
      </form>
    </div>
  </div>
  <div class="footer-bottom">&copy; 2025 Coffee Time. All Rights Reserved.</div>
</footer>

<!-- JS Logic -->
<script>
  /* --- HEADER LOGIC --- */
  window.addEventListener("scroll", () => {
    document.querySelector("header").classList.toggle("scrolled", window.scrollY > 20);
    
    // Progress Bar Logic
    let scrollTop = document.documentElement.scrollTop;
    let docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    let scrollPercent = (scrollTop / docHeight) * 100;
    document.getElementById("progress-bar").style.width = scrollPercent + "%";
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
</script>

</body>
</html>