<?php
// === HEADER CORS ===
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// === KONEKSI DATABASE (XAMPP LOCALHOST) ===
$host = "localhost";
$user = "root";     // default user XAMPP
$pass = "";         // default XAMPP: TANPA PASSWORD
$db   = "coffee_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo json_encode([
        "status" => "error",
        "message" => "Koneksi Database Gagal: " . mysqli_connect_error()
    ]);
    exit();
}
?>