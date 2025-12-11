<?php
include 'koneksi.php';

// Ambil semua produk
$query = mysqli_query($conn, "SELECT * FROM products ORDER BY id ASC");
$products = [];

while ($row = mysqli_fetch_assoc($query)) {
    // Pastikan angka stok dan harga dikirim sebagai integer
    $row['price'] = (int)$row['price'];
    $row['stock'] = (int)$row['stock'];
    $products[] = $row;
}

// Kirim JSON ke Frontend
echo json_encode($products);
?>