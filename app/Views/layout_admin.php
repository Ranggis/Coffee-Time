<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        /* CSS GLOBAL (Dipakai di semua halaman admin) */
        :root {
            --primary-brown: #3e2723;
            --secondary-brown: #5d4037;
            --bg-cream: #fdfbf7;
            --card-bg: #ffffff;
            --accent-gold: #ffc107;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-cream);
            margin: 0; display: flex;
        }
        .sidebar {
            width: 250px; background-color: var(--primary-brown); color: white;
            min-height: 100vh; padding: 20px; position: fixed;
        }
        .brand { font-size: 24px; font-weight: 600; margin-bottom: 40px; display: block; color: white; text-decoration: none; }
        .nav-links { list-style: none; padding: 0; }
        .nav-links li { margin-bottom: 15px; }
        .nav-links a { display: block; color: #d7ccc8; text-decoration: none; padding: 12px 20px; border-radius: 12px; transition: 0.3s; }
        .nav-links a:hover { background-color: rgba(255,255,255,0.1); color: white; }
        /* Warna tombol aktif */
        .nav-links a.active { background-color: rgba(255,255,255,0.15); color: white; font-weight: 600; }
        
        .main-content { margin-left: 250px; flex: 1; padding: 0; }
        .top-header {
            background-color: var(--primary-brown); color: white; padding: 15px 40px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .content-wrapper { padding: 30px 40px; }
        
        /* CSS tambahan untuk Tabel & Card */
        .card, .table-container, .section-card {
            background: var(--card-bg); border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <!-- SIDEBAR TETAP -->
    <div class="sidebar">
        <a href="/coffee-time/public/admin" class="brand">Coffee Time</a>
        <?php $uri = service('uri'); ?>
        <ul class="nav-links">
            <!-- Logika PHP sederhana untuk menentukan menu mana yang aktif -->
            <li>
                <a href="/coffee-time/public/admin" class="<?= ($uri->getSegment(2) == '') ? 'active' : '' ?>">Dashboard</a>
            </li>
            <li>
                <a href="/coffee-time/public/admin/products" class="<?= ($uri->getSegment(2) == 'products') ? 'active' : '' ?>">Produk</a>
            </li>
            <li><a href="/coffee-time/public/admin/transaksi">Transaksi</a></li>
            <li><a href="/coffee-time/public/admin/pelanggan">Pelanggan</a></li>
            <li style="margin-top: 50px;"><a href="/coffee-time/public/auth/login" style="color: #ff8a80;">Logout</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER TETAP -->
        <div class="top-header">
            <h2 style="margin:0; font-size: 22px;">Dashboard Admin</h2>
            <div style="font-size: 14px;">Halo, admin 👋</div>
        </div>

        <!-- ISI KONTEN BERUBAH-UBAH DISINI -->
        <div class="content-wrapper">
            <?= $this->renderSection('konten_admin'); ?>
        </div>
    </div>
<!-- Pastikan SweetAlert sudah dipanggil di bagian <head> atau sebelum script ini -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script Pop Up Selamat Datang -->
<script>
    // Cek apakah ada flashdata 'sapa_admin' dari Controller
    <?php if(session()->getFlashdata('sapa_admin')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: '<?= session()->getFlashdata('sapa_admin'); ?>',
            showConfirmButton: false,
            timer: 2000, // Pop up hilang otomatis setelah 2 detik
            background: '#fff',
            color: '#3e2723'
        });
    <?php endif; ?>
</script>

</body>
</html>
</body>
</html>