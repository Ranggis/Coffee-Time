<?php
// Izinkan akses dari Netlify/Localhost
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

// 1. Hitung Total Pelanggan
$q_user = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='user'");
$d_user = mysqli_fetch_assoc($q_user);

// 2. Hitung Total Transaksi
$q_trans = mysqli_query($conn, "SELECT COUNT(DISTINCT order_date) as total FROM orders");
$d_trans = mysqli_fetch_assoc($q_trans);

// 3. Hitung Total Produk
$q_prod = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
$d_prod = mysqli_fetch_assoc($q_prod);

// 4. Ambil 5 Pesanan Terbaru
$query_orders = "SELECT 
                    users.username,
                    orders.customer_name,
                    orders.order_date,
                    SUM(orders.price * orders.quantity) as total_bayar
                 FROM orders
                 JOIN users ON orders.user_id = users.id
                 GROUP BY orders.user_id, orders.order_date
                 ORDER BY orders.order_date DESC
                 LIMIT 5";
$result_orders = mysqli_query($conn, $query_orders);

$recent_orders = [];
while ($row = mysqli_fetch_assoc($result_orders)) {
    // Format nama (Prioritas customer_name, fallback username)
    $row['display_name'] = !empty($row['customer_name']) ? $row['customer_name'] : $row['username'];
    // Format tanggal agar cantik
    $row['formatted_date'] = date('d M, H:i', strtotime($row['order_date']));
    $recent_orders[] = $row;
}

// 5. Kirim Semua Data dalam 1 Paket JSON
echo json_encode([
    "status" => "success",
    "stats" => [
        "total_produk" => $d_prod['total'],
        "total_transaksi" => $d_trans['total'],
        "total_pelanggan" => $d_user['total']
    ],
    "recent_orders" => $recent_orders
]);
?>