<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function handleReturn(Request $request)
    {
        // Ambil data dari session
        $payment = session('payment');

        if (!$payment) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada transaksi yang ditemukan.');
        }

        // Tidak ada panggilan ke Midtrans, hanya pakai data session
        $statusCode = $payment['status'] ?? 'unknown';

        $statusMessage = match ($statusCode) {
            'paid' => 'Pembayaran sudah diterima. Terima kasih!',
            'pending' => 'Pembayaran masih menunggu konfirmasi.',
            'expired' => 'Pembayaran sudah kadaluarsa.',
            'cancelled' => 'Pembayaran dibatalkan.',
            default => 'Status pembayaran: ' . $statusCode,
        };

        return view('payment.payment_status', [
            'order' => (object) $payment,
            'status_message' => $statusMessage,
        ]);
    }

    public function checkStatus()
    {
        // Ambil data dari session
        $payment = session('payment');

        if (!$payment) {
            return redirect()->route('cart.index')->with('error', 'Belum ada transaksi pembayaran.');
        }

        // Tidak cek ke Midtrans, hanya tampilkan status yang tersimpan
        $statusCode = $payment['status'] ?? 'unknown';

        $statusMessage = match ($statusCode) {
            'paid' => 'Pembayaran sudah diterima. Terima kasih!',
            'pending' => 'Pembayaran masih menunggu konfirmasi.',
            'expired' => 'Pembayaran sudah kadaluarsa.',
            'cancelled' => 'Pembayaran dibatalkan.',
            default => 'Status pembayaran: ' . $statusCode,
        };

        return view('payment.payment_status', [
            'order' => (object) $payment,
            'status_message' => $statusMessage,
        ]);
    }
}