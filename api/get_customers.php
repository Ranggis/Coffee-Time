<?php
// Izinkan akses dari mana saja (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Matikan pesan error PHP agar tidak merusak format JSON
error_reporting(0); 

include 'koneksi.php';

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Koneksi Database Gagal"]);
    exit;
}

// QUERY DIPERBAIKI (Lebih Aman)
// Mengambil semua user dengan role 'user' dan history pesanan mereka
$query = "SELECT 
            u.id, 
            u.username, 
            u.created_at,
            COUNT(o.id) as total_items, 
            GROUP_CONCAT(CONCAT(o.item_name, ':', o.quantity) SEPARATOR '||') as data_belanjaan
          FROM users u
          LEFT JOIN orders o ON u.id = o.user_id
          WHERE u.role = 'user'
          GROUP BY u.id
          ORDER BY u.created_at DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    // Jika query gagal, kirim pesan error SQLnya
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    exit;
}

$customers = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Format Tanggal
    $row['formatted_date'] = date('d M Y', strtotime($row['created_at']));
    
    // Hitung ulang jumlah transaksi unik (berdasarkan waktu order)
    // Kita lakukan manual di PHP agar query SQL tidak terlalu berat/rumit
    $trx_query = mysqli_query($conn, "SELECT COUNT(DISTINCT order_date) as total_trx FROM orders WHERE user_id = " . $row['id']);
    $trx_data = mysqli_fetch_assoc($trx_query);
    $row['jumlah_checkout'] = (int)$trx_data['total_trx'];

    $customers[] = $row;
}

// Kirim JSON
echo json_encode($customers);
?>