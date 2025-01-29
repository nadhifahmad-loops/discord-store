<?php
require_once '../vendor/autoload.php'; // Pastikan SDK Midtrans sudah terinstall

use Midtrans\Snap;
use Midtrans\Transaction;

class TransactionController
{
    public function createTransaction($product_name, $price)
    {
        // Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = 'YOUR_SERVER_KEY';
        \Midtrans\Config::$isProduction = false; // Ganti jadi true di production
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Generate order_id unik
        $order_id = uniqid('order-', true);

        // Set transaksi detail
        $transaction_details = [
            'order_id' => $order_id,
            'gross_amount' => $price
        ];

        // Informasi produk
        $item_details = [
            [
                'id' => 'item01',
                'price' => $price,
                'quantity' => 1,
                'name' => $product_name
            ]
        ];

        // Data pelanggan (diisi sesuai data yang ada)
        $customer_details = [
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'email'         => 'john.doe@example.com',
            'phone'         => '081234567890',
        ];

        // Data transaksi
        $transaction_data = [
            'payment_type' => 'credit_card',
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        try {
            // Mendapatkan snap token
            $snap_token = Snap::getSnapToken($transaction_data);
            return json_encode(['token' => $snap_token]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
