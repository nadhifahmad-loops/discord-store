<?php
session_start();
require_once 'config.php';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'midtrans_db'); // Gantilah dengan konfigurasi database Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk cek email dan password
    $result = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $result->fetch_assoc();
        header('Location: /dashboard.php'); // Redirect ke halaman dashboard
    } else {
        echo "Email atau password salah.";
    }
}
?>
