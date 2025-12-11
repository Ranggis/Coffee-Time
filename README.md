<h1 align="center">Coffee Time</h1>
<p align="center">Sistem Pemesanan dan Manajemen Kedai Kopi</p>

<p align="center">
  <img src="https://github.com/Ranggis/Api-Image/blob/main/Logo.png" width="180" alt="SIG Logo"/>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Status-Active-brightgreen" />
  <img src="https://img.shields.io/badge/PHP-8.x-blue" />
  <img src="https://img.shields.io/badge/MySQL-Database-orange" />
  <img src="https://img.shields.io/badge/Frontend-HTML%2FCSS%2FJS-yellow" />
</p>

Aplikasi ini dikembangkan sebagai platform pemesanan dan manajemen produk untuk kedai kopi berbasis web. Coffee Time dibangun untuk memberikan pengalaman antarmuka yang modern, ringan, serta mudah dipahami baik oleh pelanggan maupun admin. Proyek ini menekankan pemisahan struktur frontend–backend, desain visual yang konsisten, dan alur transaksi yang jelas mulai dari login hingga checkout.

Aplikasi tidak hanya menampilkan daftar menu, tetapi menghadirkan alur pemesanan yang utuh: pengguna dapat mendaftar, masuk, memilih produk, melakukan checkout, dan menyimpan pesanan ke database. Admin dapat mengelola produk, pelanggan, dan transaksi melalui dashboard terpusat.

Semua dirancang agar sistem terlihat rapi, profesional, dan siap digunakan sebagai dasar pengembangan aplikasi berbasis web yang lebih besar.

---

## Identitas dan Desain Aplikasi

Coffee Time hadir dengan tampilan hangat dan modern untuk menyesuaikan suasana sebuah kedai kopi. Warna keemasan, cokelat lembut, dan tipografi yang bersih digunakan untuk menciptakan kesan profesional sekaligus ramah pengguna.

Setiap halaman dirancang konsisten antar perangkat, dengan struktur UI yang mempertimbangkan kenyamanan navigasi: form login yang simpel, tampilan menu yang bersih, dashboard admin yang rapi, serta proses checkout yang jelas.

Tujuan utama desain adalah menghadirkan aplikasi yang mudah digunakan, cepat dipahami, dan mampu memberikan gambaran alur transaksi secara komprehensif.

---

## Gambaran Sistem

Coffee Time Website berjalan menggunakan kombinasi HTML, CSS, JavaScript pada sisi antarmuka, dan PHP serta MySQL pada sisi backend. Sistem ini bekerja dengan memanggil API sederhana yang menangani login, registrasi, penyimpanan pesanan, dan pembaruan stok produk.

Pengguna dapat:

* Melihat menu kopi dan detail produk.
* Mendaftar akun baru dan melakukan login.
* Menambahkan pesanan ke keranjang.
* Melakukan checkout dan menyimpan transaksi.
* Mengakses dashboard untuk manajemen produk dan pelanggan.

Admin dapat:

* Mengelola daftar produk.
* Mengelola data pelanggan.
* Mencatat dan melihat transaksi.
* Mengatur stok dan harga.

Alur ini membentuk sistem pemesanan yang lengkap untuk keperluan akademik ataupun prototype bisnis sederhana.

---

## Arsitektur Interaksi

Aplikasi ini disusun melalui serangkaian interaksi yang runtut dan terstruktur:

**1. Login dan Registrasi**
Pengguna membuat akun menggunakan form registrasi. Setelah berhasil login, sesi pengguna disimpan dan digunakan untuk mengakses halaman lanjutan.

**2. Navigasi Menu Utama**
Pengguna dapat memilih kategori atau langsung melihat menu kopi beserta detailnya. Data ditampilkan dinamis sesuai struktur yang ditentukan di setiap halaman.

**3. Pemesanan dan Checkout**
Setiap produk dapat ditambahkan ke pesanan. Pengguna akan diarahkan ke halaman checkout untuk konfirmasi detail transaksi.

**4. Penyimpanan Pemesanan**
Proses checkout memanggil endpoint PHP yang menyimpan transaksi ke database dan memperbarui stok secara otomatis.

**5. Dashboard Admin**
Admin memiliki akses ke halaman khusus untuk memantau produk, pelanggan, dan transaksi melalui tampilan tabel yang terstruktur.

Arsitektur ini memastikan bahwa aplikasi tetap ringan namun memiliki alur pemesanan yang lengkap.

---

## Implementasi Backend dan API

Coffee Time menyediakan API sederhana berbasis PHP:

### Login

Mengecek kecocokan email dan password lalu memulai sesi pengguna.

### Registrasi

Menyimpan data pengguna baru ke database dan memastikan email unik.

### Pengambilan Menu

Mengambil daftar produk untuk ditampilkan ke halaman utama.

### Penyimpanan Transaksi

Menerima data pesanan dari halaman checkout dan memasukkannya ke tabel transaksi.

### Pembaruan Stok

Mengurangi stok produk setelah pesanan tersimpan.

Semua endpoint menggunakan koneksi MySQL yang didefinisikan di `koneksi.php`.

---

## Fondasi Teknologi

Aplikasi ini dibangun menggunakan teknologi web dasar yang dipisahkan dengan jelas:

* **HTML, CSS, JavaScript** untuk antarmuka pengguna.
* **PHP native** untuk proses backend.
* **MySQL** untuk penyimpanan data pengguna, produk, dan transaksi.
* **AJAX (fetch API)** untuk komunikasi tanpa reload.

Struktur proyek dibuat rapi agar mudah diperluas maupun dipelihara.

---

## Struktur Proyek

```
Coffee-Time-Website/
├── index.html
├── login.html
├── register.html
├── menu-detail.html
├── dashboard.html
├── checkout.html
│
├── styles/
│   ├── style.css
│   ├── login.css
│   └── dashboard.css
│
├── scripts/
│   ├── script.js
│   ├── dashboard.js
│   └── checkout.js
│
├── api/
│   ├── login.php
│   ├── register.php
│   ├── get_menu.php
│   ├── save_order.php
│   └── update_stock.php
│
└── assets/
    └── image/
```

Struktur ini memastikan pemisahan yang jelas antara antarmuka, logika, dan aset.

---

## Kontributor

Pengembangan aplikasi Coffee Time dikerjakan oleh tim berikut:

### Tim Pengembang Coffee Time Website

| Nama                          | NIM         |
| ----------------------------- | ----------- |
| **Salwa Aprilia Santi**       | 20230040141 |
| **M Ranggis Refaldi**         | 20230040197 |
| **Rizzi Alpadista**           | 20230040045 |
| **Kayla Puspita Khairiyah**   | 20230040159 |
| **Muhammad Faishal Setiawan** | 20230040146 |

Setiap anggota berperan dalam penyusunan konsep, rancangan antarmuka, implementasi kode, pengolahan data, dan dokumentasi proyek.
