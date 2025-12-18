<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Our Menu - Coffee Time</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@400;500;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Lato', sans-serif;
  background-color: var(--dark);
  color: var(--accent);
  overflow-x: hidden;
  min-height: 100vh;
}

h1, h2, h3 { font-family: 'Playfair Display', serif; }

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

/* Icons & Right Nav */
.nav-right { display: flex; align-items: center; z-index: 102; }
.nav-icons { display: flex; align-items: center; gap: 18px; font-size: 15px; }
.nav-icons a { color: var(--accent); text-decoration: none; transition: .3s; position: relative; }
.nav-icons a:hover { opacity: 1; transform: translateY(-2px); }
.user-name { font-size: 14px; font-weight: bold; margin-right: 5px; }

/* Badge Cart */
#cart-badge {
    position: absolute; top: -8px; right: -8px;
    background-color: #e74c3c; color: white;
    font-size: 10px; font-weight: bold;
    padding: 2px 5px; border-radius: 50%;
    display: none;
}

/* ================= MENU HERO ================= */
.menu-hero {
  height: 60vh;
  position: relative;
  background: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1600&q=80');
  background-size: cover; background-position: center; background-attachment: fixed;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; margin-top: var(--header-height);
}
.menu-hero::before {
  content: ""; position: absolute; inset: 0;
  background: radial-gradient(circle, rgba(27,15,18,0.3) 0%, rgba(27,15,18,1) 90%);
}
.hero-content { position: relative; z-index: 2; padding: 0 20px; }
.menu-hero h1 {
  font-family: 'Dancing Script', cursive; font-size: 5rem; margin-bottom: 10px;
  text-shadow: 0 5px 20px rgba(0,0,0,0.8); animation: fadeInDown 1s;
}
.menu-hero p { font-size: 1.3rem; opacity: 0.9; letter-spacing: 1px; font-weight: 300; animation: fadeInUp 1s; }

@keyframes fadeInDown { from { opacity:0; transform:translateY(-30px); } to { opacity:1; transform:translateY(0); } }
@keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }

/* ================= CATEGORY BAR ================= */
.category-bar {
  display: flex; justify-content: center; gap: 15px; padding: 25px 20px;
  background: var(--dark); position: sticky; top: var(--header-height); z-index: 40;
  border-bottom: 1px solid var(--border); overflow-x: auto;
}
.cat-pill {
  padding: 8px 30px; border-radius: 50px; border: 1px solid var(--border);
  color: var(--accent); text-decoration: none; font-size: 0.95rem; transition: 0.3s;
  white-space: nowrap; font-weight: bold; letter-spacing: 1px;
}
.cat-pill:hover, .cat-pill.active { background: var(--accent); color: var(--dark); border-color: var(--accent); }

/* ================= MENU GRID ================= */
.menu-section { padding: 60px 50px 100px; max-width: 1400px; margin: auto; }

.menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; }

.menu-card {
  background: var(--glass); border: 1px solid var(--border); border-radius: 20px;
  overflow: hidden; transition: 0.4s; position: relative; display: flex; flex-direction: column;
}
.menu-card:hover { 
  transform: translateY(-10px); background: var(--glass-hover); 
  border-color: rgba(245, 222, 179, 0.5); box-shadow: 0 15px 40px rgba(0,0,0,0.5);
}

/* Image */
.card-img-wrapper {
  height: 250px; overflow: hidden; position: relative;
  background: radial-gradient(circle, rgba(255,255,255,0.1), transparent);
}
.card-img-wrapper img {
  width: 100%; height: 100%; object-fit: contain; padding: 20px;
  transition: 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275); filter: drop-shadow(0 10px 15px rgba(0,0,0,0.6));
}
.menu-card:hover .card-img-wrapper img { transform: scale(1.1) rotate(5deg); }

/* Badge Stock */
.badge-stock {
  position: absolute; top: 15px; left: 15px; background: #e67e22; color: #fff;
  padding: 4px 10px; font-size: 0.75rem; border-radius: 5px; font-weight: bold;
}

/* Content */
.card-body { padding: 25px; text-align: center; flex: 1; display: flex; flex-direction: column; }
.card-title { font-size: 1.5rem; margin-bottom: 10px; color: #fff; line-height: 1.2; }
.card-desc { font-size: 0.9rem; opacity: 0.7; line-height: 1.6; margin-bottom: 20px; flex: 1; }

.card-footer { 
  margin-top: auto; display: flex; justify-content: space-between; align-items: center; 
  padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); 
}
.price { font-size: 1.3rem; font-weight: 700; color: var(--accent); }

/* Button */
.btn-add {
  width: 45px; height: 45px; border-radius: 50%; border: none;
  background: var(--accent); color: var(--dark); font-size: 1.2rem;
  cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center;
}
.btn-add:hover { background: #fff; box-shadow: 0 0 15px var(--accent); transform: rotate(90deg); }
.btn-disabled { background: rgba(255,255,255,0.1); color: #777; cursor: not-allowed; }

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

  .menu-hero h1 { font-size: 3.5rem; }
  .menu-section { padding: 60px 20px; }
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

    <!-- Hamburger (Mobile Only: Di Kiri Icon) -->
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
        <a href="#" id="cartBtn" onclick="goToCart()">
          <i class="fas fa-shopping-cart"></i>
          <span id="cart-badge">0</span>
        </a>
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
<section class="menu-hero">
  <div class="hero-content">
    <h1>Signature Brews</h1>
    <p>Handcrafted with passion, served with love.</p>
  </div>
</section>

<!-- CATEGORY BAR -->
<div class="category-bar">
  <a href="#" class="cat-pill active">All Menu</a>
  <a href="#" class="cat-pill">Coffee</a>
  <a href="#" class="cat-pill">Non-Coffee</a>
  <a href="#" class="cat-pill">Pastry</a>
  <a href="#" class="cat-pill">Beans</a>
</div>

<!-- MENU GRID -->
<section class="menu-section">
  <div class="menu-grid">
    <?php if (!empty($products) && is_array($products)): ?>
      <?php foreach ($products as $row): ?>
        <?php 
            $stok = $row['stock'];
            $is_sold_out = ($stok <= 0);
            $name = esc($row['name']);
            $price = $row['price'];
            $img = base_url($row['image']);
            $onclick = $is_sold_out ? "" : "onclick=\"checkLoginAndOrder('$name', $price, '$img')\"";
            $btn_icon = $is_sold_out ? "fa-ban" : "fa-plus";
            $btn_class = $is_sold_out ? "btn-add btn-disabled" : "btn-add";
        ?>

        <div class="menu-card">
          <div class="card-img-wrapper">
            <img src="<?= $img ?>" alt="<?= $name ?>">
            <?php if(!$is_sold_out && $stok < 10): ?>
                <span class="badge-stock">Sisa <?= $stok ?>!</span>
            <?php elseif($is_sold_out): ?>
                <span class="badge-stock" style="background:#c0392b;">Sold Out</span>
            <?php endif; ?>
          </div>
          
          <div class="card-body">
            <h3 class="card-title"><?= $name ?></h3>
            <p class="card-desc"><?= esc($row['description']) ?></p>
            
            <div class="card-footer">
              <span class="price">Rp <?= number_format($row['price'], 0, ',', '.') ?></span>
              <button class="<?= $btn_class ?>" <?= $onclick ?> title="Add to Order">
                <i class="fas <?= $btn_icon ?>"></i>
              </button>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    <?php else: ?>
      <p style="text-align: center; grid-column: 1/-1; font-size:1.2rem; opacity:0.7;">Menu saat ini belum tersedia.</p>
    <?php endif; ?>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="social-links">
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-twitter"></i></a>
  </div>
  <p class="copyright">&copy; 2025 Coffee Time. All Rights Reserved.</p>
</footer>

<!-- JS Logic -->
<script>
  /* --- HEADER & TOGGLE --- */
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

  /* --- CART LOGIC --- */
  const isLoggedIn = <?= (isset($is_logged_in) && $is_logged_in) ? 'true' : 'false' ?>;
  const loginUrl = "<?= base_url('auth/login') ?>"; 

  const qtyStyle = `
    <style>
      .qty-container { display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 15px; }
      .qty-btn { background: #3a241c; color: #f5deb3; border: 1px solid #f5deb3; width: 35px; height: 35px; border-radius: 5px; cursor: pointer; font-size: 18px; font-weight: bold; }
      .qty-btn:hover { background: #f5deb3; color: #3a241c; }
      .qty-input { width: 50px; text-align: center; font-size: 18px; padding: 5px; border: 1px solid #ccc; border-radius: 5px; }
      .qty-input::-webkit-outer-spin-button, .qty-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
  `;

  document.addEventListener("DOMContentLoaded", () => {
      document.head.insertAdjacentHTML("beforeend", qtyStyle);
      updateCartBadge();
  });

  function checkLoginAndOrder(name, price, img) {
      if (isLoggedIn) {
          Swal.fire({
              title: name, text: "Mau pesan berapa?", imageUrl: img, imageWidth: 150, imageHeight: 150,
              html: `
                <div class="qty-container">
                    <button type="button" class="qty-btn" onclick="adjustQty(-1)">-</button>
                    <input type="number" id="swal-qty" class="qty-input" value="1" min="1" readonly>
                    <button type="button" class="qty-btn" onclick="adjustQty(1)">+</button>
                </div>
                <p style="margin-top:10px; font-size:14px; opacity:0.8;">Harga Satuan: Rp ${new Intl.NumberFormat('id-ID').format(price)}</p>
              `,
              showCancelButton: true, confirmButtonColor: '#f5deb3', cancelButtonColor: '#d33',
              confirmButtonText: '<span style="color:#1b0f12; font-weight:bold;">Order Sekarang</span>',
              background: '#1b0f12', color: '#f5deb3',
              preConfirm: () => { return document.getElementById('swal-qty').value; }
          }).then((result) => {
              if (result.isConfirmed) {
                  const qty = parseInt(result.value);
                  addToCart(name, price, qty);
                  Swal.fire({
                      icon: 'success', title: 'Berhasil!',
                      html: `${qty}x ${name} masuk keranjang.`,
                      background: '#1b0f12', color: '#f5deb3', confirmButtonColor: '#f5deb3', timer: 1500, showConfirmButton: false
                  });
              }
          });
      } else {
          Swal.fire({
              title: 'Login Required', text: 'Silakan login dulu.', icon: 'warning',
              background: '#1b0f12', color: '#f5deb3', showCancelButton: true, confirmButtonColor: '#f5deb3',
              cancelButtonColor: '#d33', confirmButtonText: '<span style="color:#1b0f12;">Login Now</span>'
          }).then((result) => { if (result.isConfirmed) window.location.href = loginUrl; });
      }
  }

  window.adjustQty = function(change) {
      const input = document.getElementById('swal-qty');
      let val = parseInt(input.value); val += change; if (val < 1) val = 1; input.value = val;
  };

  function addToCart(name, price, qty) {
      let cart = JSON.parse(localStorage.getItem('coffee_cart')) || [];
      let existingItem = cart.find(item => item.name === name);
      if (existingItem) { existingItem.qty += qty; } else { cart.push({ name: name, price: price, qty: qty }); }
      localStorage.setItem('coffee_cart', JSON.stringify(cart));
      updateCartBadge();
  }

  function updateCartBadge() {
      let cart = JSON.parse(localStorage.getItem('coffee_cart')) || [];
      let totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
      const badge = document.getElementById('cart-badge');
      if (totalQty > 0) {
          badge.style.display = 'inline-block'; badge.innerText = totalQty;
          badge.style.transform = "scale(1.3)"; setTimeout(() => badge.style.transform = "scale(1)", 200);
      } else { badge.style.display = 'none'; }
  }

  document.getElementById('cartBtn').onclick = function(e) {
      e.preventDefault();
      let cart = JSON.parse(localStorage.getItem('coffee_cart')) || [];
      if (cart.length === 0) {
          Swal.fire({ icon: 'info', title: 'Keranjang Kosong', text: 'Yuk pesan kopi dulu!', background: '#1b0f12', color: '#f5deb3', confirmButtonColor: '#f5deb3' });
      } else {
          let listHtml = '<ul style="text-align:left; list-style:none; padding:0; font-size:0.9rem;">';
          let grandTotal = 0;
          cart.forEach(item => {
              let subtotal = item.price * item.qty; grandTotal += subtotal;
              listHtml += `<li style="border-bottom:1px solid #444; padding:10px 0; display:flex; justify-content:space-between;"><span>${item.name} (${item.qty}x)</span><b>Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}</b></li>`;
          });
          listHtml += '</ul>';
          listHtml += `<h3 style="text-align:right; margin-top:15px; color:#f5deb3;">Total: Rp ${new Intl.NumberFormat('id-ID').format(grandTotal)}</h3>`;
          Swal.fire({
              title: 'Keranjang Belanja', html: listHtml, background: '#1b0f12', color: '#fff',
              showCancelButton: true, confirmButtonText: '<span style="color:#1b0f12; font-weight:bold;">Checkout</span>',
              confirmButtonColor: '#f5deb3', cancelButtonText: 'Tutup', cancelButtonColor: '#d33',
              showDenyButton: true, denyButtonText: 'Kosongkan', denyButtonColor: '#555'
          }).then((result) => {
              if (result.isConfirmed) { window.location.href = "<?= base_url('checkout') ?>"; }
              else if (result.isDenied) { localStorage.removeItem('coffee_cart'); updateCartBadge(); Swal.fire('Keranjang dikosongkan', '', 'success'); }
          });
      }
  };
</script>

</body>
</html>