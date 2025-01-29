<?php
require_once '../vendor/autoload.php';

\Midtrans\Config::$serverKey = 'YOUR_SERVER_KEY';
\Midtrans\Config::$isProduction = false;

$notif = new \Midtrans\Notification();

// Ambil status transaksi
$transaction_status = $notif->transaction_status;
$fraud_status = $notif->fraud_status;
$order_id = $notif->order_id;

// Log status transaksi
file_put_contents("logs/payment_status.log", "Order ID: $order_id, Status: $transaction_status, Fraud Status: $fraud_status\n", FILE_APPEND);

// Proses status transaksi
if ($transaction_status == 'capture') {
    if ($fraud_status == 'accept') {
        echo "Pembayaran berhasil!";
        // Ubah status transaksi menjadi "paid" di database Anda
    } else {
        echo "Pembayaran fraud.";
    }
} elseif ($transaction_status == 'settlement') {
    echo "Pembayaran berhasil!";
    // Ubah status transaksi menjadi "paid" di database Anda
} elseif ($transaction_status == 'pending') {
    echo "Pembayaran sedang diproses.";
} elseif ($transaction_status == 'deny') {
    echo "Pembayaran ditolak.";
} else {
    echo "Status pembayaran tidak diketahui.";
}
?>
