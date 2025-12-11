<?php
// === HEADER CORS (WAJIB ADA) ===
// Ini mengizinkan Frontend (Netlify/Localhost) untuk mengakses Backend ini
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight request (Opsional tapi bagus untuk stabilitas)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// === KONEKSI DATABASE ===
// Nanti ubah sesuai data dari cPanel kamu
$host = "localhost";
$user = "root";          // Ganti dengan User Database cPanel
$pass = "";              // Ganti dengan Password Database cPanel
$db   = "coffee_db";     // Ganti dengan Nama Database cPanel

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Koneksi Database Gagal: " . mysqli_connect_error()]);
    exit();
}
?>