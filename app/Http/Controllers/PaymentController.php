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
            $status = MidtransTransaction::status($transactions->order_id);

            if ($status->transaction_status == 'settlement' || $status->transaction_status == 'capture') {
                $transactions->order_status = 'completed';
            } elseif ($status->transaction_status == 'pending') {
                $transactions->order_status = 'pending';
            } elseif ($status->transaction_status == 'expire') {
                $transactions->order_status = 'expired';
            } elseif ($status->transaction_status == 'cancel') {
                $transactions->order_status = 'cancelled';
            } else {
                $transactions->status = $status->transaction_status;
            }

            $transactions->save();

            return view('user.payment_status', [
                'order' => $transactions,
                'status_message' => 'Payment status has been updated automatically.'
            ]);

        } catch (\Exception $e) {
            return redirect()->route('payment.status', $transactions)
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

            if ($status->transaction_status == 'settlement' || $status->transaction_status == 'capture') {
                $transactions->status = 'paid';
            } elseif ($status->transaction_status == 'pending') {
                $transactions->status = 'pending';
            } elseif ($status->transaction_status == 'expire') {
                $transactions->status = 'expired';
            } elseif ($status->transaction_status == 'cancel') {
                $transactions->status = 'cancelled';
            } else {
                $transactions->status = $status->transaction_status;
            }

            $transactions->save();

            return view('user.payment_status', [
                'order' => $transactions,
                'status_message' => 'Payment status checked manually.'
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to check payment status: ' . $e->getMessage());
        }
    }
}