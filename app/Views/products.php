<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Our Products - Coffee Time</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* === VARIABEL GLOBAL === */
:root {
  --dark: #1b0f12;
  --brown: #3a241c;
  --accent: #f5deb3;
  --glass: rgba(255, 255, 255, 0.05);
  --border: rgba(245, 222, 179, 0.2);
  --header-height: 80px;
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

/* Hamburger */
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

/* ================= PRODUCT HERO ================= */
.product-hero {
  height: 60vh;
  background: linear-gradient(rgba(27,15,18,0.7), rgba(27,15,18,1)), url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=1600&q=80');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 0 20px;
  margin-top: var(--header-height);
}

.product-hero h1 {
  font-family: 'Dancing Script', cursive;
  font-size: 4rem;
  margin-bottom: 15px;
  text-shadow: 0 5px 15px rgba(0,0,0,0.5);
}

.product-hero p { font-size: 1.2rem; opacity: 0.9; max-width: 600px; }

/* ================= CATALOG SECTION ================= */
.catalog-section { padding: 60px 50px 100px; max-width: 1400px; margin: auto; }

/* Filter Buttons */
.filter-container {
  display: flex; justify-content: center; gap: 15px; margin-bottom: 50px; flex-wrap: wrap;
}

.filter-btn {
  padding: 10px 25px;
  background: transparent;
  border: 1px solid var(--accent);
  color: var(--accent);
  border-radius: 50px;
  cursor: pointer;
  font-family: inherit;
  font-weight: bold;
  transition: 0.3s;
}

.filter-btn:hover, .filter-btn.active {
  background: var(--accent);
  color: var(--dark);
  box-shadow: 0 0 15px rgba(245, 222, 179, 0.4);
}

/* Product Grid */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 40px;
}

/* Product Card */
.product-card {
  background: var(--glass);
  border: 1px solid var(--border);
  border-radius: 15px;
  overflow: hidden;
  transition: 0.4s;
  position: relative;
  display: flex;
  flex-direction: column;
}

.product-card:hover {
  transform: translateY(-10px);
  border-color: var(--accent);
  box-shadow: 0 15px 30px rgba(0,0,0,0.5);
}

/* Image Wrapper */
.card-img {
  width: 100%;
  height: 250px;
  overflow: hidden;
  position: relative;
  background: rgba(0,0,0,0.2);
}

.card-img img {
  width: 100%; height: 100%; object-fit: cover;
  transition: 0.5s;
}

.product-card:hover .card-img img { transform: scale(1.1); }

/* Badge */
.badge {
  position: absolute; top: 15px; left: 15px;
  background: var(--accent); color: var(--dark);
  padding: 5px 12px; font-size: 12px; font-weight: bold;
  border-radius: 4px; z-index: 2;
}

/* Content */
.card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; }

.category-tag { font-size: 12px; opacity: 0.6; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }

.card-body h3 { font-size: 1.4rem; margin-bottom: 10px; color: #fff; }

.rating { color: #f1c40f; font-size: 12px; margin-bottom: 15px; }

.price-row {
  margin-top: auto; /* Push ke bawah */
  display: flex; align-items: center; justify-content: space-between;
}

.price { font-size: 1.3rem; font-weight: bold; color: var(--accent); }

.btn-cart {
  width: 40px; height: 40px; border-radius: 50%;
  background: rgba(255,255,255,0.1); border: none;
  color: var(--accent); cursor: pointer; transition: 0.3s;
  display: flex; align-items: center; justify-content: center;
}

.btn-cart:hover { background: var(--accent); color: var(--dark); }

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

  .product-hero h1 { font-size: 2.5rem; }
  .catalog-section { padding: 40px 20px; }
  .filter-container { gap: 10px; }
  .filter-btn { padding: 8px 16px; font-size: 13px; }
}
</style>
</head>
<body>

<!-- Backdrop Mobile -->
<div class="menu-backdrop" id="menu-backdrop"></div>

<!-- HEADER (HEADER STANDARD KITA) -->
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

<!-- HERO SECTION -->
<section class="product-hero">
  <h1>Premium Selection</h1>
  <p>Bring the authentic coffee shop experience to your home with our carefully curated products.</p>
</section>

<!-- CATALOG SECTION -->
<section class="catalog-section">
  
  <!-- Filter -->
  <div class="filter-container">
    <button class="filter-btn active" onclick="filterSelection('all')">All Products</button>
    <button class="filter-btn" onclick="filterSelection('beans')">Coffee Beans</button>
    <button class="filter-btn" onclick="filterSelection('equipment')">Equipment</button>
    <button class="filter-btn" onclick="filterSelection('merch')">Merchandise</button>
  </div>

  <!-- Grid -->
  <div class="product-grid">

    <!-- Item 1: Beans -->
    <div class="product-card filter-item beans">
      <div class="card-img">
        <span class="badge">Best Seller</span>
        <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&w=600&q=80" alt="Arabica Gayo">
      </div>
      <div class="card-body">
        <span class="category-tag">Coffee Beans</span>
        <h3>Arabica Gayo Premium</h3>
        <div class="rating">
          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> (5.0)
        </div>
        <div class="price-row">
          <span class="price">Rp 85.000</span>
          <button class="btn-cart" onclick="addToCartMsg('Arabica Gayo')"><i class="fas fa-shopping-bag"></i></button>
        </div>
      </div>
    </div>

    <!-- Item 2: Beans -->
    <div class="product-card filter-item beans">
      <div class="card-img">
        <img src="https://images.unsplash.com/photo-1611854779393-1b2ae9d97d02?auto=format&fit=crop&w=600&q=80" alt="Robusta Lampung">
      </div>
      <div class="card-body">
        <span class="category-tag">Coffee Beans</span>
        <h3>Robusta Lampung Gold</h3>
        <div class="rating">
          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> (4.8)
        </div>
        <div class="price-row">
          <span class="price">Rp 65.000</span>
          <button class="btn-cart" onclick="addToCartMsg('Robusta Lampung')"><i class="fas fa-shopping-bag"></i></button>
        </div>
      </div>
    </div>

    <!-- Item 3: Equipment -->
    <div class="product-card filter-item equipment">
      <div class="card-img">
        <span class="badge" style="background:#e74c3c;">Sale</span>
        <img src="https://images.unsplash.com/photo-1565453006698-a17d6a5924d0?auto=format&fit=crop&w=600&q=80" alt="French Press">
      </div>
      <div class="card-body">
        <span class="category-tag">Brewing Gear</span>
        <h3>Classic French Press</h3>
        <div class="rating">
          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> (4.2)
        </div>
        <div class="price-row">
          <span class="price">Rp 120.000</span>
          <button class="btn-cart" onclick="addToCartMsg('French Press')"><i class="fas fa-shopping-bag"></i></button>
        </div>
      </div>
    </div>

    <!-- Item 4: Equipment -->
    <div class="product-card filter-item equipment">
      <div class="card-img">
        <img src="https://images.unsplash.com/photo-1544979105-045a55734ea6?auto=format&fit=crop&w=600&q=80" alt="V60 Dripper">
      </div>
      <div class="card-body">
        <span class="category-tag">Brewing Gear</span>
        <h3>V60 Ceramic Dripper</h3>
        <div class="rating">
          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> (4.9)
        </div>
        <div class="price-row">
          <span class="price">Rp 150.000</span>
          <button class="btn-cart" onclick="addToCartMsg('V60 Dripper')"><i class="fas fa-shopping-bag"></i></button>
        </div>
      </div>
    </div>

    <!-- Item 5: Merch -->
    <div class="product-card filter-item merch">
      <div class="card-img">
        <img src="https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?auto=format&fit=crop&w=600&q=80" alt="Tumbler">
      </div>
      <div class="card-body">
        <span class="category-tag">Merchandise</span>
        <h3>Signature Tumbler</h3>
        <div class="rating">
          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> (5.0)
        </div>
        <div class="price-row">
          <span class="price">Rp 199.000</span>
          <button class="btn-cart" onclick="addToCartMsg('Tumbler')"><i class="fas fa-shopping-bag"></i></button>
        </div>
      </div>
    </div>
    
  </div>
</section>

<!-- JS Logic -->
<script>
  /* --- FILTER LOGIC --- */
  function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("filter-item");
    
    // Update active button
    var btns = document.getElementsByClassName("filter-btn");
    for (var j = 0; j < btns.length; j++) {
      btns[j].classList.remove("active");
    }
    // Add active to clicked (not capturing click event details here for simplicity, assumes direct call)
    event.currentTarget.classList.add("active");

    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; // Hide all
      if (x[i].className.indexOf(c) > -1) {
        x[i].style.display = "flex"; // Show match
      }
    }
  }

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

  /* --- ADD TO CART ANIMATION --- */
  function addToCartMsg(name) {
    Swal.fire({
      icon: 'success',
      title: 'Added to Bag',
      text: name + ' has been added to your shopping bag!',
      background: '#1b0f12',
      color: '#f5deb3',
      showConfirmButton: false,
      timer: 1500
    });
  }
</script>

</body>
</html>