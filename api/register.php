<?php
include 'koneksi.php';

$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['username']) && isset($input['password'])) {
    $username = mysqli_real_escape_string($conn, $input['username']);
    $password = mysqli_real_escape_string($conn, $input['password']);

    // Cek username kembar
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(["status" => "error", "message" => "Username sudah terpakai"]);
    } else {
        // Insert user baru (Default role: user)
        $insert = mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')");
        
        if ($insert) {
            echo json_encode(["status" => "success", "message" => "Registrasi Berhasil"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal Mendaftar"]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Input kurang"]);
}
?>