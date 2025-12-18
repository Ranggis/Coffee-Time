<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Our Blog - Coffee Time</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@400;500;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
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
  --glass-hover: rgba(255, 255, 255, 0.1);
  --text-muted: rgba(245, 222, 179, 0.6);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Lato', sans-serif; /* Body font lebih modern */
  background-color: var(--dark);
  color: var(--accent);
  overflow-x: hidden;
}

h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

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

/* Hamburger (Mobile Only) */
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

/* Icons */
.nav-right { display: flex; align-items: center; z-index: 102; }
.nav-icons { display: flex; align-items: center; gap: 18px; font-size: 15px; }
.nav-icons a { color: var(--accent); text-decoration: none; transition: .3s; }
.nav-icons a:hover { opacity: 1; transform: translateY(-2px); }
.user-name { font-size: 14px; font-weight: bold; margin-right: 5px; }

/* ================= ANIMATION CLASSES ================= */
.reveal {
  opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out;
}
.reveal.active { opacity: 1; transform: translateY(0); }

/* ================= BLOG HERO ================= */
.blog-hero {
  height: 60vh;
  position: relative;
  background: url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=1600&q=80');
  background-size: cover; background-position: center; background-attachment: fixed;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; margin-top: var(--header-height);
}
/* Overlay Gradient */
.blog-hero::before {
  content: ""; position: absolute; inset: 0;
  background: radial-gradient(circle, rgba(27,15,18,0.4) 0%, rgba(27,15,18,1) 90%);
}

.hero-content { position: relative; z-index: 2; max-width: 800px; padding: 0 20px; }
.blog-hero h1 {
  font-family: 'Dancing Script', cursive; font-size: 5rem; margin-bottom: 10px;
  text-shadow: 0 5px 20px rgba(0,0,0,0.8);
  animation: fadeInDown 1s ease;
}
.blog-hero p { 
  font-size: 1.3rem; opacity: 0.9; letter-spacing: 1px; font-weight: 300;
  animation: fadeInUp 1s ease 0.3s backwards;
}

@keyframes fadeInDown { from { opacity:0; transform:translateY(-30px); } to { opacity:1; transform:translateY(0); } }
@keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }

/* ================= CATEGORY BAR ================= */
.category-bar {
  display: flex; justify-content: center; gap: 15px; padding: 30px 20px;
  background: var(--dark); position: sticky; top: var(--header-height); z-index: 40;
  border-bottom: 1px solid var(--border); overflow-x: auto;
}
.cat-pill {
  padding: 8px 25px; border-radius: 50px; border: 1px solid var(--border);
  color: var(--accent); text-decoration: none; font-size: 0.9rem; transition: 0.3s;
  white-space: nowrap;
}
.cat-pill:hover, .cat-pill.active { background: var(--accent); color: var(--dark); border-color: var(--accent); }

/* ================= BLOG CONTENT ================= */
.blog-container { max-width: 1200px; margin: auto; padding: 60px 50px 100px; }

/* FEATURED POST (WOW EFFECT) */
.featured-post {
  display: flex; align-items: stretch; gap: 0;
  background: var(--glass); border: 1px solid var(--border); border-radius: 20px;
  overflow: hidden; margin-bottom: 80px; min-height: 450px;
  transition: 0.3s;
}
.featured-post:hover { box-shadow: 0 0 40px rgba(245, 222, 179, 0.15); border-color: var(--accent); }

.fp-img { flex: 1.5; position: relative; overflow: hidden; }
.fp-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s ease; }
.featured-post:hover .fp-img img { transform: scale(1.05); }

.fp-content { 
  flex: 1; padding: 50px; display: flex; flex-direction: column; justify-content: center;
  background: linear-gradient(135deg, rgba(255,255,255,0.03), transparent);
}
.badge-cat { 
  display: inline-block; background: var(--accent); color: var(--dark); 
  padding: 5px 12px; font-size: 0.75rem; font-weight: bold; border-radius: 4px;
  text-transform: uppercase; width: fit-content; margin-bottom: 15px;
}
.fp-title { font-size: 2.8rem; margin-bottom: 20px; line-height: 1.1; color: #fff; }
.fp-desc { font-size: 1.05rem; opacity: 0.8; line-height: 1.7; margin-bottom: 30px; font-weight: 300; }
.fp-meta { display: flex; align-items: center; gap: 15px; font-size: 0.9rem; color: var(--text-muted); }
.author-img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid var(--accent); }

/* GRID LAYOUT */
.blog-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; }

.blog-card {
  background: var(--glass); border: 1px solid var(--border); border-radius: 15px;
  overflow: hidden; transition: 0.4s; display: flex; flex-direction: column;
}
.blog-card:hover { transform: translateY(-10px); background: var(--glass-hover); border-color: rgba(245, 222, 179, 0.4); }

.card-img { height: 240px; overflow: hidden; position: relative; }
.card-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s; }
.blog-card:hover .card-img img { transform: scale(1.1) rotate(2deg); }

.card-body { padding: 25px; flex: 1; display: flex; flex-direction: column; }
.card-date { font-size: 0.85rem; color: var(--accent); margin-bottom: 10px; display: block; }
.card-title { font-size: 1.6rem; margin-bottom: 15px; line-height: 1.3; color: #fff; transition: 0.3s; }
.blog-card:hover .card-title { color: var(--accent); }
.card-excerpt { font-size: 0.95rem; opacity: 0.7; line-height: 1.6; margin-bottom: 20px; font-weight: 300; }

.card-footer {
  margin-top: auto; display: flex; justify-content: space-between; align-items: center;
  border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;
}
.read-time { font-size: 0.85rem; opacity: 0.6; display: flex; align-items: center; gap: 5px; }
.btn-arrow { 
  width: 35px; height: 35px; border-radius: 50%; border: 1px solid var(--accent);
  display: flex; align-items: center; justify-content: center; color: var(--accent); transition: 0.3s; text-decoration: none;
}
.btn-arrow:hover { background: var(--accent); color: var(--dark); }

/* ================= NEWSLETTER SECTION ================= */
.newsletter-section {
  background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=1600&q=80');
  background-size: cover; background-attachment: fixed;
  padding: 100px 20px; text-align: center;
}
.newsletter-content { max-width: 600px; margin: auto; }
.newsletter-content h2 { font-family: 'Dancing Script'; font-size: 3.5rem; margin-bottom: 15px; }
.newsletter-content p { margin-bottom: 30px; font-size: 1.1rem; }

.subscribe-form { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; }
.subscribe-form input {
  padding: 15px 20px; border-radius: 50px; border: none; outline: none;
  width: 100%; max-width: 350px; font-family: inherit;
}
.subscribe-form button {
  padding: 15px 30px; border-radius: 50px; border: none; background: var(--accent);
  color: var(--dark); font-weight: bold; cursor: pointer; transition: 0.3s;
}
.subscribe-form button:hover { background: #fff; box-shadow: 0 0 20px rgba(245, 222, 179, 0.5); }

/* ================= FOOTER ================= */
footer {
  background: #11090a; padding: 40px 0; text-align: center; border-top: 1px solid var(--border);
}
.social-links { margin-bottom: 20px; }
.social-links a {
  color: var(--accent); font-size: 1.2rem; margin: 0 10px; transition: 0.3s;
  display: inline-block; width: 40px; height: 40px; line-height: 40px;
  border: 1px solid rgba(245, 222, 179, 0.2); border-radius: 50%;
}
.social-links a:hover { background: var(--accent); color: var(--dark); transform: translateY(-3px); }
.copyright { font-size: 0.9rem; opacity: 0.5; }

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

  /* Blog Responsive */
  .blog-hero h1 { font-size: 3.5rem; }
  .blog-container { padding: 40px 20px; }
  .featured-post { flex-direction: column; }
  .fp-img { min-height: 250px; flex: 1; }
  .fp-content { padding: 30px 20px; }
  .fp-title { font-size: 2rem; }
  .category-bar { justify-content: flex-start; } /* Scrollable on mobile */
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
<section class="blog-hero">
  <div class="hero-content">
    <h1>The Daily Roast</h1>
    <p>Exploring the art, culture, and science behind your perfect cup.</p>
  </div>
</section>

<!-- CATEGORY BAR -->
<div class="category-bar">
  <a href="#" class="cat-pill active">All Stories</a>
  <a href="#" class="cat-pill">Brewing Guides</a>
  <a href="#" class="cat-pill">Beans & Origins</a>
  <a href="#" class="cat-pill">Lifestyle</a>
  <a href="#" class="cat-pill">Barista Tips</a>
</div>

<!-- CONTENT -->
<section class="blog-container">

  <!-- Featured Post -->
  <article class="featured-post reveal">
    <div class="fp-img">
      <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=80" alt="Brewing Method">
    </div>
    <div class="fp-content">
      <span class="badge-cat">Knowledge</span>
      <h2 class="fp-title">The Secret to a Cleaner V60 Pour Over</h2>
      <p class="fp-desc">
        Mengapa teknik V60 begitu digemari? Kami membedah rahasia di balik bentuk kerucut sederhana ini yang mampu mengeluarkan notes buah dan bunga dari biji kopi favorit Anda.
      </p>
      <div class="fp-meta">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="author-img" alt="Author">
        <div>
          <span>By <strong>Ranggis</strong></span><br>
          <span style="font-size:0.8rem">Oct 12, 2025 • 5 min read</span>
        </div>
      </div>
    </div>
  </article>

  <!-- Blog Grid -->
  <div class="blog-grid">
    
    <!-- Post 1 -->
    <article class="blog-card reveal">
      <div class="card-img">
        <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=600&q=80" alt="Latte Art">
      </div>
      <div class="card-body">
        <span class="card-date">Sep 28, 2025</span>
        <h3 class="card-title">Sejarah Singkat & Teknik Dasar Latte Art</h3>
        <p class="card-excerpt">Seni melukis di atas kopi bukan sekadar estetika, tapi bukti tekstur susu (microfoam) yang sempurna.</p>
        <div class="card-footer">
          <span class="read-time"><i class="far fa-clock"></i> 4 min read</span>
          <a href="#" class="btn-arrow"><i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </article>

    <!-- Post 2 -->
    <article class="blog-card reveal">
      <div class="card-img">
        <img src="https://images.unsplash.com/photo-1611854779393-1b2ae9d97d02?auto=format&fit=crop&w=600&q=80" alt="Robusta vs Arabica">
      </div>
      <div class="card-body">
        <span class="card-date">Sep 15, 2025</span>
        <h3 class="card-title">Arabica vs Robusta: Apa Sebenarnya Bedanya?</h3>
        <p class="card-excerpt">Memahami perbedaan rasa, kadar kafein, dan tempat tumbuh dua raksasa dunia kopi ini.</p>
        <div class="card-footer">
          <span class="read-time"><i class="far fa-clock"></i> 6 min read</span>
          <a href="#" class="btn-arrow"><i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </article>

    <!-- Post 3 -->
    <article class="blog-card reveal">
      <div class="card-img">
        <img src="https://images.unsplash.com/photo-1442512595367-42732509d3a4?auto=format&fit=crop&w=600&q=80" alt="Coffee Shop Vibes">
      </div>
      <div class="card-body">
        <span class="card-date">Aug 30, 2025</span>
        <h3 class="card-title">Psikologi 'Coffee Shop Effect'</h3>
        <p class="card-excerpt">Mengapa kita sering merasa lebih produktif saat bekerja di tengah kebisingan mesin kopi di cafe?</p>
        <div class="card-footer">
          <span class="read-time"><i class="far fa-clock"></i> 3 min read</span>
          <a href="#" class="btn-arrow"><i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </article>

  </div>

</section>

<!-- NEWSLETTER SECTION -->
<section class="newsletter-section">
  <div class="newsletter-content reveal">
    <h2>Join the Club</h2>
    <p>Dapatkan tips seduh eksklusif dan promo biji kopi terbaru langsung ke inbox Anda.</p>
    <form class="subscribe-form" onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');">
      <input type="email" placeholder="Masukkan email Anda..." required>
      <button type="submit">Subscribe</button>
    </form>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="social-links">
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-youtube"></i></a>
  </div>
  <p class="copyright">&copy; 2025 Coffee Time. Brewed with passion.</p>
</footer>

<!-- JS Logic -->
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

  /* --- SCROLL REVEAL ANIMATION --- */
  function reveal() {
    var reveals = document.querySelectorAll(".reveal");
    for (var i = 0; i < reveals.length; i++) {
      var windowHeight = window.innerHeight;
      var elementTop = reveals[i].getBoundingClientRect().top;
      var elementVisible = 100;
      if (elementTop < windowHeight - elementVisible) {
        reveals[i].classList.add("active");
      }
    }
  }
  window.addEventListener("scroll", reveal);
  reveal(); // Trigger once on load
</script>

</body>
</html>