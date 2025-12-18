<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Coffee Time - Experience the Taste</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* === VARIABEL & RESET === */
:root {
  --dark: #0f0809;
  --brown: #3a241c;
  --accent: #f5deb3; /* Wheat color */
  --accent-hover: #e0cda7;
  --header-height: 80px;
  --border: rgba(245, 222, 179, 0.15);
  --glass: rgba(255, 255, 255, 0.05);
  --text-muted: rgba(245, 222, 179, 0.7);
}

* { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; }

body {
  font-family: 'Lato', sans-serif;
  background-color: var(--dark);
  color: var(--accent);
  overflow-x: hidden;
  position: relative;
}

/* Texture Overlay (Film Grain Effect) */
body::before {
  content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background-image: url("https://www.transparenttextures.com/patterns/stardust.png");
  opacity: 0.06; pointer-events: none; z-index: 0;
}

h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

/* === SCROLL REVEAL ANIMATION === */
.reveal {
  opacity: 0; transform: translateY(50px); transition: all 1s ease;
}
.reveal.active { opacity: 1; transform: translateY(0); }

/* ================= HEADER ================= */
header {
  position: fixed; top: 0; left: 0; width: 100%; height: var(--header-height);
  z-index: 100;
  background: linear-gradient(to bottom, rgba(15,8,9,0.9), rgba(15,8,9,0.6));
  border-bottom: 1px solid rgba(255,255,255,0.05);
  display: flex; align-items: center; transition: 0.4s;
  backdrop-filter: blur(10px);
}
header.scrolled { background: rgba(15,8,9,0.98); box-shadow: 0 10px 30px rgba(0,0,0,0.5); border-bottom-color: var(--border); }

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
.menu-toggle:hover { transform: scale(1.1); color: #fff; }

/* Menu Desktop */
.menu { display: flex; gap: 30px; list-style: none; font-size: 14px; letter-spacing: 1px; }
.menu li a {
  text-decoration: none; color: var(--accent); opacity: 0.7; transition: 0.3s;
  position: relative; padding-bottom: 5px; text-transform: uppercase; font-size: 0.85rem; font-weight: 700;
}
.menu li a::after {
  content: ""; position: absolute; left: 0; bottom: 0; width: 0%; height: 1px;
  background: var(--accent); transition: width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.menu li a:hover, .menu li a.active { opacity: 1; }
.menu li a:hover::after, .menu li a.active::after { width: 100%; }

/* Icons */
.nav-right { display: flex; align-items: center; z-index: 102; }
.nav-icons { display: flex; align-items: center; gap: 20px; font-size: 16px; }
.nav-icons a { color: var(--accent); text-decoration: none; transition: 0.3s; }
.nav-icons a:hover { opacity: 1; transform: translateY(-2px); color: #fff; }
.user-name { font-size: 14px; font-weight: 700; margin-right: 5px; letter-spacing: 0.5px; }

/* ================= HERO SECTION ================= */
.hero {
  min-height: 100vh; position: relative;
  display: flex; align-items: center; padding: 0 50px;
  background: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat fixed;
  overflow: hidden;
}
/* Dark Overlay */
.hero::before {
  content: ""; position: absolute; inset: 0;
  background: radial-gradient(circle at center, rgba(15,8,9,0.4) 0%, rgba(15,8,9,0.9) 100%);
}

.hero-text {
  max-width: 650px; z-index: 2; position: relative;
}

.hero-subtitle {
  font-size: 1rem; text-transform: uppercase; letter-spacing: 4px; color: var(--accent);
  margin-bottom: 15px; display: block; animation: fadeInUp 1s ease;
}

.hero-text h1 {
  font-size: 5rem; margin-bottom: 20px; line-height: 1.1; color: #fff;
  text-shadow: 0 10px 30px rgba(0,0,0,0.5);
}

.typing span {
  opacity: 0; display: inline-block; transform: translateY(20px);
  animation: reveal 0.5s forwards;
}
@keyframes reveal { to { opacity: 1; transform: translateY(0); } }

.hero-text p {
  font-size: 1.2rem; line-height: 1.8; opacity: 0.9; margin-bottom: 40px; font-weight: 300;
  color: #ddd; max-width: 550px; animation: fadeInUp 1s ease 0.5s backwards;
}

/* Buttons */
.hero-buttons { display: flex; gap: 20px; animation: fadeInUp 1s ease 0.8s backwards; }
.btn-link {
  text-decoration: none; padding: 15px 40px; border-radius: 50px;
  font-size: 0.9rem; letter-spacing: 1px; transition: 0.3s; display: inline-block;
  font-weight: bold; text-transform: uppercase; border: 1px solid var(--accent);
}
.btn-primary { background: var(--accent); color: var(--dark); }
.btn-primary:hover { background: #fff; border-color: #fff; box-shadow: 0 0 25px rgba(245, 222, 179, 0.4); }
.btn-outline { background: transparent; color: var(--accent); }
.btn-outline:hover { background: rgba(245,222,179,0.1); color: #fff; border-color: #fff; }

/* Scroll Indicator */
.scroll-indicator {
  position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
  display: flex; flex-direction: column; align-items: center; gap: 10px; opacity: 0.7;
  animation: bounce 2s infinite; z-index: 2;
}
.mouse {
  width: 26px; height: 42px; border: 2px solid var(--accent); border-radius: 20px; position: relative;
}
.wheel {
  width: 4px; height: 8px; background: var(--accent); border-radius: 2px;
  position: absolute; top: 8px; left: 50%; transform: translateX(-50%);
}
@keyframes bounce { 0%, 20%, 50%, 80%, 100% {transform:translate(-50%,0);} 40% {transform:translate(-50%, -10px);} 60% {transform:translate(-50%, -5px);} }
@keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }


/* ================= FEATURES SECTION ================= */
.features-section {
  padding: 100px 50px; position: relative; z-index: 2;
  background: linear-gradient(to bottom, var(--dark), #1a1012);
}
.features-grid {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 40px; max-width: 1200px; margin: auto;
}
.feature-card {
  background: var(--glass); border: 1px solid var(--border); padding: 40px;
  border-radius: 15px; text-align: center; transition: 0.4s;
}
.feature-card:hover {
  transform: translateY(-10px); border-color: var(--accent);
  box-shadow: 0 20px 50px rgba(0,0,0,0.3); background: rgba(255,255,255,0.08);
}
.f-icon {
  font-size: 3rem; color: var(--accent); margin-bottom: 20px; display: inline-block;
}
.feature-card h3 { font-size: 1.5rem; margin-bottom: 15px; color: #fff; }
.feature-card p { opacity: 0.7; line-height: 1.6; font-size: 0.95rem; }


/* ================= ABOUT TEASER SECTION ================= */
.about-teaser {
  padding: 120px 50px; position: relative; z-index: 2; max-width: 1300px; margin: auto;
  display: flex; align-items: center; gap: 80px;
}
.about-img-group {
  flex: 1; position: relative;
}
.img-main {
  width: 100%; border-radius: 10px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);
  filter: sepia(20%); transition: 0.5s;
}
.img-main:hover { filter: sepia(0%); transform: scale(1.02); }
.img-badge {
  position: absolute; bottom: -30px; right: -30px; background: var(--accent);
  color: var(--dark); padding: 30px; border-radius: 50%; font-family: 'Dancing Script';
  font-size: 1.5rem; font-weight: bold; width: 120px; height: 120px;
  display: flex; align-items: center; justify-content: center; text-align: center;
  box-shadow: 0 10px 30px rgba(0,0,0,0.3); animation: spin 10s linear infinite;
}
@keyframes spin { 100% { transform: rotate(360deg); } }

.about-content { flex: 1; }
.section-tag { color: var(--accent); text-transform: uppercase; letter-spacing: 2px; font-weight: bold; font-size: 0.9rem; margin-bottom: 10px; display: block; }
.about-content h2 { font-size: 3.5rem; margin-bottom: 30px; line-height: 1.1; color: #fff; }
.about-content p { font-size: 1.1rem; opacity: 0.8; line-height: 1.8; margin-bottom: 40px; }


/* ================= BANNER / QUOTE ================= */
.banner-section {
  background: url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=1600&q=80') center/cover fixed;
  padding: 150px 20px; text-align: center; position: relative; z-index: 2;
}
.banner-overlay {
  position: absolute; inset: 0; background: rgba(15,8,9,0.7);
}
.banner-content { position: relative; z-index: 2; max-width: 800px; margin: auto; }
.banner-content h2 {
  font-family: 'Dancing Script'; font-size: 4rem; color: var(--accent); margin-bottom: 20px;
}
.banner-content p { font-size: 1.5rem; color: #fff; font-style: italic; opacity: 0.9; }


/* ================= FOOTER ================= */
footer {
  background: #0b0506; border-top: 1px solid var(--border); padding: 80px 50px 30px;
  position: relative; z-index: 2;
}
.footer-grid {
  max-width: 1200px; margin: auto; display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 50px;
}
.ft-about h3 { font-family: 'Dancing Script'; font-size: 2.5rem; margin-bottom: 20px; color: var(--accent); }
.ft-about p { opacity: 0.7; line-height: 1.8; margin-bottom: 20px; font-size: 0.9rem; }
.socials a {
  color: var(--accent); font-size: 1.2rem; margin-right: 15px; transition: 0.3s;
  display: inline-flex; width: 40px; height: 40px; border: 1px solid var(--border);
  align-items: center; justify-content: center; border-radius: 50%;
}
.socials a:hover { background: var(--accent); color: var(--dark); transform: translateY(-5px); }

.ft-links h4 { font-size: 1rem; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
.ft-links ul { list-style: none; }
.ft-links li { margin-bottom: 12px; }
.ft-links a { text-decoration: none; color: rgba(255,255,255,0.6); transition: 0.3s; font-size: 0.9rem; }
.ft-links a:hover { color: var(--accent); padding-left: 5px; }

.footer-bottom {
  text-align: center; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 30px;
  font-size: 0.85rem; opacity: 0.5;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
  nav { padding: 0 20px; }
  
  /* Mobile Header Logic */
  .menu-toggle { display: block; margin-left: auto; margin-right: 20px; }
  .user-name { display: none; }

  .menu {
    position: fixed; top: 0; right: 0; width: 75%; max-width: 300px; height: 100vh;
    background: #1a1012; flex-direction: column; justify-content: flex-start;
    padding: 100px 30px; gap: 30px; font-size: 18px;
    transform: translateX(100%); transition: 0.4s cubic-bezier(0.77, 0, 0.175, 1);
    box-shadow: -10px 0 40px rgba(0,0,0,0.5); z-index: 101; 
  }
  .menu.active { transform: translateX(0); }

  .menu-backdrop {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.8); z-index: 100; opacity: 0; pointer-events: none; transition: 0.3s;
  }
  .menu-backdrop.active { opacity: 1; pointer-events: all; }

  /* Content Mobile */
  .hero { flex-direction: column; justify-content: center; text-align: center; padding: 130px 20px 50px; }
  .hero-text h1 { font-size: 3.5rem; }
  .hero-buttons { justify-content: center; }
  .scroll-indicator { display: none; }

  .features-grid { grid-template-columns: 1fr; }
  
  .about-teaser { flex-direction: column; padding: 60px 20px; gap: 40px; text-align: center; }
  .about-content h2 { font-size: 2.5rem; }
  .img-badge { width: 90px; height: 90px; font-size: 1.2rem; bottom: -20px; right: 0; }

  .footer-grid { grid-template-columns: 1fr; gap: 40px; text-align: center; }
  .socials { justify-content: center; display: flex; }
}
</style>
</head>
<body>

<!-- Backdrop Mobile -->
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
      <li><a href="<?= base_url('/') ?>" class="active">Home</a></li>
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

<!-- HERO SECTION -->
<section class="hero">
  <div class="hero-text">
    <span class="hero-subtitle">Welcome to Coffee Time</span>
    <h1 id="typing" class="typing"></h1>
    <p>
      Start your day with the perfect brew. Discover flavors that ignite your passion and comfort your soul.
    </p>
    <div class="hero-buttons">
      <a href="<?= base_url('menu') ?>" class="btn-link btn-primary">Order Now</a>
      <a href="<?= base_url('about') ?>" class="btn-link btn-outline">Explore More</a>
    </div>
  </div>
  
  <div class="scroll-indicator">
    <div class="mouse"><div class="wheel"></div></div>
    <span style="font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; color:#fff;">Scroll</span>
  </div>
</section>

<!-- FEATURES SECTION (REVEAL) -->
<section class="features-section">
  <div class="features-grid">
    <div class="feature-card reveal">
      <div class="f-icon"><i class="fas fa-mug-hot"></i></div>
      <h3>Premium Beans</h3>
      <p>Sourced from the best organic farms, roasted to perfection for that rich aroma.</p>
    </div>
    <div class="feature-card reveal">
      <div class="f-icon"><i class="fas fa-award"></i></div>
      <h3>Expert Baristas</h3>
      <p>Served by professionals who know the art and science behind every cup.</p>
    </div>
    <div class="feature-card reveal">
      <div class="f-icon"><i class="fas fa-store"></i></div>
      <h3>Cozy Ambience</h3>
      <p>A perfect place to relax, work, or catch up with friends with calm vibes.</p>
    </div>
  </div>
</section>

<!-- ABOUT TEASER (REVEAL) -->
<section class="about-teaser">
  <div class="about-img-group reveal">
    <img src="https://images.unsplash.com/photo-1498804103079-a6351b050096?auto=format&fit=crop&w=800&q=80" alt="Coffee Shop" class="img-main">
    <div class="img-badge">Est.<br>2025</div>
  </div>
  <div class="about-content reveal">
    <span class="section-tag">Our Story</span>
    <h2>Brewing Moments, Creating Memories</h2>
    <p>
      Di Coffee Time, kopi bukan sekadar minuman hitam pekat. Ini adalah sebuah perjalanan rasa, dedikasi petani, dan kehangatan dalam setiap tegukan. Kami hadir untuk menemani setiap momen berharga Anda.
    </p>
    <a href="<?= base_url('about') ?>" class="btn-link btn-outline">Read Our Story</a>
  </div>
</section>

<!-- BANNER QUOTE -->
<section class="banner-section reveal">
  <div class="banner-overlay"></div>
  <div class="banner-content">
    <h2>"Life begins after coffee."</h2>
    <p>- Coffee Time Philosophy</p>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="ft-about">
      <h3>Coffee Time</h3>
      <p>Menyajikan cerita di setiap cangkir. Tempat di mana rasa, aroma, dan kehangatan bertemu. Berdiri sejak 2025.</p>
      <div class="socials">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>
    </div>
    
    <div class="ft-links">
      <h4>Discover</h4>
      <ul>
        <li><a href="<?= base_url('menu') ?>">Our Menu</a></li>
        <li><a href="<?= base_url('products') ?>">Products</a></li>
        <li><a href="<?= base_url('gallery') ?>">Gallery</a></li>
        <li><a href="<?= base_url('blog') ?>">Journal</a></li>
      </ul>
    </div>

    <div class="ft-links">
      <h4>Support</h4>
      <ul>
        <li><a href="<?= base_url('contact') ?>">Contact Us</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms & Conditions</a></li>
      </ul>
    </div>

    <div class="ft-links">
      <h4>Newsletter</h4>
      <p style="font-size:0.9rem; opacity:0.6; margin-bottom:15px;">Subscribe for latest updates & promos.</p>
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
  /* --- HEADER & SCROLL LOGIC --- */
  window.addEventListener("scroll", () => {
    document.querySelector("header").classList.toggle("scrolled", window.scrollY > 20);
    
    // Reveal Animation
    var reveals = document.querySelectorAll(".reveal");
    for (var i = 0; i < reveals.length; i++) {
      var windowHeight = window.innerHeight;
      var elementTop = reveals[i].getBoundingClientRect().top;
      var elementVisible = 150;
      if (elementTop < windowHeight - elementVisible) {
        reveals[i].classList.add("active");
      }
    }
  });

  /* --- TYPING ANIMATION --- */
  const text = "Experience Real Coffee";
  const typingElement = document.getElementById("typing");
  typingElement.innerHTML = "";
  [...text].forEach((char, index) => {
    const span = document.createElement("span");
    span.textContent = char === " " ? "\u00A0" : char;
    span.style.animationDelay = `${index * 0.08}s`;
    typingElement.appendChild(span);
  });

  /* --- MOBILE MENU --- */
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