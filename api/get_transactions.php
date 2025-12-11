<?php
// Izinkan akses CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

// Query Transaksi Lengkap
$query = "SELECT 
            users.username,
            orders.customer_name, 
            orders.order_date,
            GROUP_CONCAT(CONCAT(orders.item_name, ' (', orders.quantity, ')') SEPARATOR ', ') as menu_list,
            SUM(orders.price * orders.quantity) as total_bayar
          FROM orders
          JOIN users ON orders.user_id = users.id
          GROUP BY orders.user_id, orders.order_date
          ORDER BY orders.order_date DESC";

$result = mysqli_query($conn, $query);
$transactions = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Format Data untuk Frontend
    $row['display_name'] = !empty($row['customer_name']) ? $row['customer_name'] : $row['username'];
    $row['formatted_date'] = date('d M Y', strtotime($row['order_date']));
    $row['formatted_time'] = date('H:i', strtotime($row['order_date'])) . ' WIB';
    $row['total_bayar'] = (int)$row['total_bayar']; // Pastikan integer
    
    // Pecah menu_list jadi array biar enak di JS
    $row['menu_items'] = explode(', ', $row['menu_list']);
    
    $transactions[] = $row;
}

echo json_encode($transactions);
?>