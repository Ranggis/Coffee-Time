<?php
// api/update_stock.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['id']) && isset($input['stock'])) {
    $id = (int) $input['id'];
    $stock = (int) $input['stock'];

    $query = "UPDATE products SET stock = $stock WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Stok berhasil diupdate"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal update database"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
}
?>