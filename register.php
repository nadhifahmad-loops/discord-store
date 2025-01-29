<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data pengguna baru
    $conn = new mysqli('localhost', 'root', '', 'midtrans_db'); // Gantilah dengan konfigurasi database Anda
    $conn->query("INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')");

    echo "Akun berhasil dibuat. <a href='/login.html'>Login sekarang</a>";
}
?>
