<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Signature Blends - Coffee Time</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root {
  --dark: #1b0f12;
  --brown: #3a241c;
  --accent: #f5deb3; /* Warna Emas/Krem */
  --glass: rgba(255, 255, 255, 0.03);
  --border: rgba(245, 222, 179, 0.15);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Playfair Display', serif;
  background: radial-gradient(circle at center, #3a241c 0%, #1b0f12 80%);
  color: var(--accent);
  min-height: 100vh;
  overflow-x: hidden;
}

/* NAVBAR (Konsisten) */
header {
  position: fixed; top: 0; width: 100%; z-index: 50;
  background: rgba(27,15,18,0.9); backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--border);
  padding: 15px 0;
}
nav {
  max-width: 1200px; margin: auto; display: flex; justify-content: space-between; align-items: center; padding: 0 30px;
}
.brand { display: flex; align-items: center; gap: 10px; text-decoration: none; color: var(--accent); }
.brand span { font-family: 'Dancing Script', cursive; font-size: 28px; }
.nav-link { color: var(--accent); text-decoration: none; font-size: 14px; margin-left: 20px; transition: 0.3s; }
.nav-link:hover { opacity: 0.7; }

/* HEADER TITLE */
.page-header {
  text-align: center; margin-top: 140px; margin-bottom: 60px;
}
.page-header h1 {
  font-family: 'Dancing Script', cursive; font-size: 4rem; margin-bottom: 10px;
}
.page-header p {
  font-size: 1.1rem; opacity: 0.8; letter-spacing: 1px; max-width: 600px; margin: auto;
}
.divider {
  width: 100px; height: 2px; background: var(--accent); margin: 20px auto; opacity: 0.5;
}

/* MENU LIST LAYOUT */
.showcase-container {
  max-width: 1000px; margin: auto; padding-bottom: 100px;
}

/* ITEM CARD (Tampilan Horizontal Elegan) */
.menu-row {
  display: flex; align-items: center; gap: 40px;
  background: linear-gradient(90deg, rgba(255,255,255,0.02), transparent);
  border: 1px solid var(--border);
  padding: 30px;
  margin-bottom: 40px;
  border-radius: 15px;
  position: relative;
  transition: 0.4s;
}

.menu-row:hover {
  background: rgba(255,255,255,0.05);
  transform: scale(1.02);
  border-color: var(--accent);
}

/* Image Styling */
.menu-img-wrapper {
  flex-shrink: 0; width: 180px; height: 180px; position: relative;
}
.menu-img {
  width: 100%; height: 100%; object-fit: contain;
  filter: drop-shadow(0 10px 20px rgba(0,0,0,0.6));
  transition: 0.4s;
}
.menu-row:hover .menu-img { transform: rotate(5deg) scale(1.1); }

/* Text Content */
.menu-details { flex-grow: 1; }

.menu-header {
  display: flex; justify-content: space-between; align-items: baseline;
  border-bottom: 1px dashed rgba(245, 222, 179, 0.3);
  padding-bottom: 10px; margin-bottom: 15px;
}

.menu-title { font-size: 2rem; font-weight: 700; color: #fff; }
.menu-price { font-size: 1.5rem; font-family: 'Dancing Script', cursive; color: var(--accent); }

.menu-desc {
  font-size: 1rem; line-height: 1.8; opacity: 0.8; margin-bottom: 15px;
}

/* Rating & Tags */
.menu-meta {
  display: flex; gap: 20px; align-items: center; font-size: 0.9rem;
}
.rating { color: #f1c40f; }
.tag {
  background: rgba(245, 222, 179, 0.1);
  padding: 4px 12px; border-radius: 20px;
  font-size: 0.8rem; letter-spacing: 1px;
  text-transform: uppercase;
}

/* Responsive */
@media (max-width: 768px) {
  .menu-row { flex-direction: column; text-align: center; }
  .menu-header { flex-direction: column; gap: 5px; border: none; }
  .menu-meta { justify-content: center; }
}
</style>
</head>
<body>

<header>
  <nav>
    <a href="<?= base_url('/') ?>" class="brand">
      <i class="fas fa-mug-hot"></i><span>Coffee Time</span>
    </a>
    <div>
        <!-- Link kembali ke Home -->
        <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
        <!-- Link untuk Order jika mereka berubah pikiran -->
        <a href="<?= base_url('menu') ?>" class="nav-link" style="border:1px solid var(--accent); padding:8px 20px; border-radius:20px;">Order Now</a>
    </div>
  </nav>
</header>

<div class="page-header">
  <h1>The Collection</h1>
  <div class="divider"></div>
  <p>Explore the details, the aroma, and the passion behind every cup we serve.</p>
</div>

<div class="showcase-container">

  <?php if (!empty($products)): ?>
    <?php foreach ($products as $index => $row): ?>
      
      <div class="menu-row">
        <!-- Gambar -->
        <div class="menu-img-wrapper">
          <img src="<?= base_url($row['image']) ?>" alt="<?= esc($row['name']) ?>" class="menu-img">
        </div>

        <!-- Detail -->
        <div class="menu-details">
          <div class="menu-header">
            <h2 class="menu-title"><?= esc($row['name']) ?></h2>
            <span class="menu-price">Rp <?= number_format($row['price'], 0, ',', '.') ?></span>
          </div>
          
          <p class="menu-desc">
            <?= esc($row['description']) ?>
            <br><br>
            <!-- Kalimat Marketing Tambahan (Static) -->
            <em style="color: #bbb;">"Perfectly brewed to start your day with energy and passion."</em>
          </p>

          <div class="menu-meta">
            <!-- Rating Bintang -->
            <div class="rating">
                <?php
                    $rating = $row['rating'];
                    for($i=0; $i<5; $i++) {
                        if($i < floor($rating)) echo '<i class="fas fa-star"></i>';
                        elseif($i < $rating) echo '<i class="fas fa-star-half-alt"></i>';
                        else echo '<i class="far fa-star"></i>';
                    }
                ?>
                <span style="color:#aaa; margin-left:5px;">(<?= $rating ?>)</span>
            </div>

            <!-- Tag Tambahan (Hiasan) -->
            <?php if($index == 0): ?>
                <span class="tag">🏆 Best Seller</span>
            <?php elseif($index == 1): ?>
                <span class="tag">✨ Barista Choice</span>
            <?php else: ?>
                <span class="tag">☕ Premium</span>
            <?php endif; ?>
          </div>
        </div>
      </div>

    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center;">Coming Soon.</p>
  <?php endif; ?>

</div>

</body>
</html>