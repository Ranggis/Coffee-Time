<?php
include 'koneksi.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validasi data
if (!$data || !isset($data['items'])) {
    echo json_encode(['status' => 'error', 'message' => 'Data pesanan tidak valid']);
    exit;
}

// Ambil data dari JSON (Dikirim oleh checkout.html)
$user_id = isset($data['user_id']) ? $data['user_id'] : 0; // ID user yang login
$customer_name = isset($data['customer_name']) ? mysqli_real_escape_string($conn, $data['customer_name']) : 'Guest';
$items = $data['items'];
$waktu_transaksi = date("Y-m-d H:i:s"); 

$success_count = 0;

foreach ($items as $item) {
    $item_name = mysqli_real_escape_string($conn, $item['name']);
    $price = (int) $item['price'];
    $qty = (int) $item['qty'];
    
    // 1. Update Stok (Kurangi stok di database)
    $query_update = "UPDATE products SET stock = stock - $qty WHERE name = '$item_name' AND stock >= $qty";
    mysqli_query($conn, $query_update);

    // 2. Jika stok berhasil dikurangi, simpan ke tabel orders
    if (mysqli_affected_rows($conn) > 0) {
        $sql = "INSERT INTO orders (user_id, customer_name, item_name, price, quantity, order_date) 
                VALUES ('$user_id', '$customer_name', '$item_name', '$price', '$qty', '$waktu_transaksi')";
        
        if (mysqli_query($conn, $sql)) {
            $success_count++;
        }
    }
}

if ($success_count > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Stok habis atau terjadi kesalahan']);
}
?>