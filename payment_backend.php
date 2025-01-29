<?php
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';
$paymentFile = 'payment_status.json';

// Cek status pembayaran
if ($action === 'check') {
    if (file_exists($paymentFile)) {
        echo file_get_contents($paymentFile);  // Mengambil status pembayaran
    } else {
        echo json_encode(["status" => "pending"]);  // Status default jika file tidak ada
    }
} elseif ($action === 'confirm') {
    $status = ["status" => "paid"];  // Status setelah konfirmasi pembayaran
    file_put_contents($paymentFile, json_encode($status));  // Simpan status pembayaran ke file
    echo json_encode($status);  // Kirim status konfirmasi
} else {
    echo json_encode(["error" => "Invalid action"]);
}
?>
