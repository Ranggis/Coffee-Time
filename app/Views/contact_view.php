<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Contact Us - Coffee Time</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* === VARIABEL & RESET === */
:root {
  --dark: #0f0809;
  --brown: #3a241c;
  --accent: #f5deb3;
  --header-height: 80px;
  --border: rgba(245, 222, 179, 0.15);
  --glass: rgba(255, 255, 255, 0.03); 
  --text-muted: rgba(245, 222, 179, 0.6);
}

* { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
html { scroll-behavior: smooth; }

body {
  font-family: 'Lato', sans-serif;
  background-color: var(--dark);
  color: var(--accent);
  overflow-x: hidden;
  position: relative;
}

/* Texture Overlay */
body::before {
  content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background-image: url("https://www.transparenttextures.com/patterns/stardust.png");
  opacity: 0.05; pointer-events: none; z-index: 0;
}

h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

/* ================= HEADER (KONSISTEN) ================= */
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

/* Menu Desktop */
.menu { display: flex; gap: 30px; list-style: none; font-size: 14px; letter-spacing: 0.5px; }
.menu li a { text-decoration: none; color: var(--accent); opacity: 0.7; transition: 0.3s; position: relative; padding-bottom: 5px; }
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

/* ================= CONTACT HERO (PARALLAX) ================= */
.contact-hero {
  height: 50vh; position: relative;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; overflow: hidden; margin-top: 0;
}
.contact-hero-bg {
  position: absolute; top: 0; left: 0; width: 100%; height: 100%;
  background: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
  filter: brightness(0.3); transform: scale(1.1); z-index: -1;
  animation: bgZoom 20s infinite alternate;
}
@keyframes bgZoom { from { transform: scale(1.1); } to { transform: scale(1.2); } }

.hero-content { z-index: 2; padding: 0 20px; }
.hero-title {
  font-family: 'Playfair Display', serif; font-size: 4.5rem; line-height: 1;
  margin-bottom: 15px; color: #fff; text-shadow: 0 10px 30px rgba(0,0,0,0.5);
}
.hero-desc {
  font-size: 1.1rem; opacity: 0.8; font-weight: 300; letter-spacing: 1px;
}

/* ================= CONTACT SECTION (MAIN) ================= */
.contact-wrapper {
  max-width: 1200px; margin: -80px auto 100px; position: relative; z-index: 10;
  padding: 0 50px;
}

.contact-box {
  display: flex; flex-wrap: wrap;
  background: rgba(20, 12, 14, 0.8); backdrop-filter: blur(20px);
  border: 1px solid var(--border); border-radius: 20px; overflow: hidden;
  box-shadow: 0 30px 60px rgba(0,0,0,0.5);
}

/* LEFT SIDE: INFO */
.info-col {
  flex: 1; padding: 60px;
  background: linear-gradient(135deg, rgba(255,255,255,0.03), transparent);
  border-right: 1px solid var(--border);
  display: flex; flex-direction: column; justify-content: space-between;
}

.info-title { font-size: 2.5rem; margin-bottom: 20px; color: #fff; }
.info-desc { font-size: 1rem; opacity: 0.7; line-height: 1.6; margin-bottom: 40px; }

.info-list { list-style: none; }
.info-item { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 30px; }
.icon-box {
  width: 50px; height: 50px; background: rgba(245, 222, 179, 0.1); border: 1px solid var(--border);
  border-radius: 50%; display: flex; align-items: center; justify-content: center;
  font-size: 1.2rem; color: var(--accent); flex-shrink: 0;
}
.info-text h4 { font-size: 1.1rem; color: #fff; margin-bottom: 5px; }
.info-text p { font-size: 0.9rem; opacity: 0.6; line-height: 1.5; }

.social-links { display: flex; gap: 15px; margin-top: 20px; }
.social-link {
  width: 40px; height: 40px; border: 1px solid var(--accent); border-radius: 50%;
  display: flex; align-items: center; justify-content: center; color: var(--accent);
  transition: 0.3s;
}
.social-link:hover { background: var(--accent); color: var(--dark); transform: translateY(-3px); }

/* RIGHT SIDE: FORM */
.form-col {
  flex: 1.2; padding: 60px;
  background: rgba(10, 5, 5, 0.6);
}

.form-title { font-family: 'Dancing Script'; font-size: 3rem; margin-bottom: 30px; color: var(--accent); }

/* Floating Label Input */
.form-group { position: relative; margin-bottom: 30px; }
.form-input {
  width: 100%; padding: 15px 0; background: transparent; border: none;
  border-bottom: 1px solid rgba(255,255,255,0.2); color: #fff; font-size: 1rem;
  transition: 0.3s; font-family: inherit;
}
.form-input:focus { border-bottom-color: var(--accent); }
.form-label {
  position: absolute; top: 15px; left: 0; color: rgba(255,255,255,0.5);
  pointer-events: none; transition: 0.3s; font-size: 1rem;
}
.form-input:focus ~ .form-label,
.form-input:valid ~ .form-label {
  top: -10px; font-size: 0.8rem; color: var(--accent);
}

/* Button */
.btn-send {
  padding: 15px 40px; background: transparent; border: 1px solid var(--accent);
  color: var(--accent); font-weight: bold; font-size: 0.9rem; letter-spacing: 1px;
  text-transform: uppercase; border-radius: 50px; cursor: pointer; transition: 0.3s;
  display: inline-flex; align-items: center; gap: 10px;
}
.btn-send:hover { background: var(--accent); color: var(--dark); box-shadow: 0 0 20px rgba(245, 222, 179, 0.4); }

/* ================= MAP SECTION ================= */
.map-container {
  width: 100%; height: 450px; position: relative;
  border-top: 1px solid var(--border);
}
.map-frame {
  width: 100%; height: 100%; border: 0;
  filter: grayscale(100%) invert(92%) contrast(83%); /* Efek Dark Map */
}
.map-overlay {
  position: absolute; inset: 0; pointer-events: none;
  background: linear-gradient(to bottom, var(--dark), transparent 20%, transparent 80%, var(--dark));
}

/* ================= FOOTER ================= */
footer {
  background: #0b0506; padding: 60px 50px 30px; position: relative; z-index: 2; border-top: 1px solid var(--border);
}
.footer-grid { max-width: 1200px; margin: auto; display: grid; grid-template-columns: 1.5fr 1fr 1fr; gap: 40px; }
.ft-about h3 { font-family: 'Dancing Script'; font-size: 2.5rem; margin-bottom: 20px; color: var(--accent); }
.ft-about p { opacity: 0.7; line-height: 1.8; margin-bottom: 20px; font-size: 0.9rem; }
.ft-links h4 { font-size: 1rem; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
.ft-links ul { list-style: none; }
.ft-links li { margin-bottom: 10px; }
.ft-links a { text-decoration: none; color: rgba(255,255,255,0.6); transition: 0.3s; font-size: 0.9rem; }
.ft-links a:hover { color: var(--accent); }
.footer-bottom { text-align: center; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px; margin-top: 40px; font-size: 0.85rem; opacity: 0.5; }

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
    transform: translateX(100%); transition: 0.4s; box-shadow: -10px 0 40px rgba(0,0,0,0.5); z-index: 101; 
  }
  .menu.active { transform: translateX(0); }

  .menu-backdrop {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.8); z-index: 100; opacity: 0; pointer-events: none; transition: 0.3s;
  }
  .menu-backdrop.active { opacity: 1; pointer-events: all; }

  /* Content Mobile */
  .contact-hero { height: 40vh; }
  .hero-title { font-size: 3rem; }
  
  .contact-wrapper { padding: 0 20px; margin-top: -40px; }
  .contact-box { flex-direction: column; }
  .info-col, .form-col { padding: 40px 25px; border-right: none; }
  .info-col { border-bottom: 1px solid var(--border); }
  
  .footer-grid { grid-template-columns: 1fr; gap: 30px; text-align: center; }
}
</style>
</head>
<body>

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
      <li><a href="<?= base_url('contact') ?>" class="active">Contact</a></li>
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
<section class="contact-hero">
  <div class="contact-hero-bg"></div>
  <div class="hero-content">
    <h1 class="hero-title">Get in Touch</h1>
    <p class="hero-desc">We'd love to hear from you. Let's brew something great together.</p>
  </div>
</section>

<!-- MAIN CONTACT AREA -->
<section class="contact-wrapper">
  <div class="contact-box">
    
    <!-- Left: Info -->
    <div class="info-col">
      <div>
        <h2 class="info-title">Let's Talk</h2>
        <p class="info-desc">Punya pertanyaan seputar kopi atau ingin kerjasama? Jangan ragu untuk menghubungi kami atau mampir ke kedai.</p>
        
        <div class="info-list">
          <div class="info-item">
            <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
            <div class="info-text">
              <h4>Our Location</h4>
              <p>Jl. Kopi Senja No. 21, Sukabumi<br>West Java, Indonesia</p>
            </div>
          </div>
          <div class="info-item">
            <div class="icon-box"><i class="fas fa-envelope"></i></div>
            <div class="info-text">
              <h4>Email Us</h4>
              <p>hello@coffeetime.id<br>support@coffeetime.id</p>
            </div>
          </div>
          <div class="info-item">
            <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
            <div class="info-text">
              <h4>Call Us</h4>
              <p>+62 812 3456 7890<br>(0266) 123 456</p>
            </div>
          </div>
        </div>
      </div>

      <div class="social-links">
        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
        <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>

    <!-- Right: Form -->
    <div class="form-col">
      <h2 class="form-title">Send a Message</h2>
      <form id="msgForm" onsubmit="sendMessage(event)">
        
        <div class="form-group">
          <input type="text" class="form-input" required>
          <label class="form-label">Your Name</label>
        </div>

        <div class="form-group">
          <input type="email" class="form-input" required>
          <label class="form-label">Email Address</label>
        </div>

        <div class="form-group">
          <input type="text" class="form-input" required>
          <label class="form-label">Subject</label>
        </div>

        <div class="form-group">
          <textarea class="form-input" rows="4" required></textarea>
          <label class="form-label">Your Message</label>
        </div>

        <button type="submit" class="btn-send">
          Send Message <i class="fas fa-paper-plane"></i>
        </button>

      </form>
    </div>

  </div>
</section>

<!-- MAP -->
<div class="map-container">
  <iframe class="map-frame" 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126907.03961129422!2d106.7369363673003!3d-6.284102909267922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1ec2422b423%3A0xbc0c44d6219b4496!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1709228392122!5m2!1sid!2sid" 
    allowfullscreen="" loading="lazy">
  </iframe>
  <div class="map-overlay"></div>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="ft-about">
      <h3>Coffee Time</h3>
      <p>Menyajikan cerita di setiap cangkir. Tempat di mana rasa, aroma, dan kehangatan bertemu.</p>
    </div>
    <div class="ft-links">
      <h4>Discover</h4>
      <ul>
        <li><a href="<?= base_url('menu') ?>">Our Menu</a></li>
        <li><a href="<?= base_url('products') ?>">Products</a></li>
        <li><a href="<?= base_url('blog') ?>">Journal</a></li>
      </ul>
    </div>
    <div class="ft-links">
      <h4>Support</h4>
      <ul>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Shipping</a></li>
        <li><a href="#">Returns</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">&copy; 2025 Coffee Time. All Rights Reserved.</div>
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

  /* --- FORM SEND LOGIC --- */
  function sendMessage(e) {
    e.preventDefault();
    Swal.fire({
      icon: 'success', title: 'Message Sent!',
      text: 'Terima kasih, pesan Anda telah kami terima.',
      background: '#1b0f12', color: '#f5deb3',
      confirmButtonColor: '#f5deb3', confirmButtonText: '<span style="color:#1b0f12; font-weight:bold;">OK</span>'
    }).then(() => { document.getElementById('msgForm').reset(); });
  }
</script>

</body>
</html>