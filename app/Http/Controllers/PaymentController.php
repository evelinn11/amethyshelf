<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Transaction as MidtransTransaction;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function handleReturn(Transaction $transactions)
    {
        // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {

            /** @var object $status */
            $status = MidtransTransaction::status($transactions->invoice_number);

            $transactions->order_status = match ($status->transaction_status) {
                'settlement', 'capture' => 'completed',
                'pending' => 'pending',
                'expire' => 'expired',
                'cancel' => 'cancelled',
                default => $status->transaction_status,
            };

            $transactions->payment_method = match ($status->payment_type) {
                'bank_transfer'      => 'Bank Transfer',
                'echannel'           => 'Mandiri Bill Payment',
                'gopay'              => 'GoPay',
                'qris'               => 'QRIS',
                'cstore'             => 'Convenience Store',
                'credit_card'        => 'Credit Card',
                'shopeepay'          => 'ShopeePay',
                'akulaku'            => 'Akulaku',
                'kredivo'            => 'Kredivo',
                'uobezpay'           => 'UOB EZPay',
                'bca_klikpay'        => 'BCA KlikPay',
                'bca_klikbca'        => 'KlikBCA',
                'bri_epay'           => 'BRI ePay',
                'danamon_online'     => 'Danamon Online Banking',
                'indomaret'          => 'Indomaret',
                'alfamart'           => 'Alfamart',
                default              => ucfirst(str_replace('_', ' ', $status->payment_type)), // fallback
            };

            $transactions->save();

            return view('user.payment_status', [
                'transactions' => $transactions,
                'status_message' => 'Payment status has been updated automatically.'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('payment.status', $transactions->id)
                ->with('error', 'Auto-check failed: ' . $e->getMessage());
        }
    }

    public function checkStatus(Transaction $transactions)
    {
        // Same as handleReturn logic
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            /** @var object $status */
            $status = MidtransTransaction::status($transactions->invoice_number);

            $transactions->order_status = match ($status->transaction_status) {
                'settlement', 'capture' => 'completed',
                'pending' => 'pending',
                'expire' => 'expired',
                'cancel' => 'cancelled',
                default => $status->transaction_status,
            };

            $transactions->payment_method = match ($status->payment_type) {
                'bank_transfer'      => 'Bank Transfer',
                'echannel'           => 'Mandiri Bill Payment',
                'gopay'              => 'GoPay',
                'qris'               => 'QRIS',
                'cstore'             => 'Convenience Store',
                'credit_card'        => 'Credit Card',
                'shopeepay'          => 'ShopeePay',
                'akulaku'            => 'Akulaku',
                'kredivo'            => 'Kredivo',
                'uobezpay'           => 'UOB EZPay',
                'bca_klikpay'        => 'BCA KlikPay',
                'bca_klikbca'        => 'KlikBCA',
                'bri_epay'           => 'BRI ePay',
                'danamon_online'     => 'Danamon Online Banking',
                'indomaret'          => 'Indomaret',
                'alfamart'           => 'Alfamart',
                default              => ucfirst(str_replace('_', ' ', $status->payment_type)), // fallback
            };

            $transactions->save();

            return view('user.payment_status', [
                'transactions' => $transactions,
                'status_message' => 'Payment status checked manually.'
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to check payment status: ' . $e->getMessage());
        }
    }

    public function cancelTransaction(Transaction $transaction)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            // Cancel ke Midtrans
            $response = MidtransTransaction::cancel($transaction->invoice_number);

            // Update ke database lokal
            $transaction->order_status = 'cancelled';
            $transaction->save();

            return redirect()->back()->with('success', 'Transaction has been cancelled.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel: ' . $e->getMessage());
        }
    }
}
