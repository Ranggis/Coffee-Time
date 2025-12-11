<?php
include 'koneksi.php';

// Terima data JSON dari Frontend
$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['username']) && isset($input['password'])) {
    $username = mysqli_real_escape_string($conn, $input['username']);
    $password = mysqli_real_escape_string($conn, $input['password']);

    // Cek user di tabel
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        
        // Kirim data user balik ke Frontend
        echo json_encode([
            "status" => "success",
            "message" => "Login Berhasil",
            "user_id" => $data['id'],
            "username" => $data['username'],
            "role" => $data['role']
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Username atau Password salah"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
}
?>