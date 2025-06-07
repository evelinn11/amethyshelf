<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show()
    {
        $userId = Auth::id(); // ambil id user yang sedang login
        $orders = Transaction::where('users_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders', compact('orders'));
    }

    public function details($id)
    {
        $userId = Auth::id(); // ambil id user yang sedang login

        $order = Transaction::with(['details.product.primaryImage'])
            ->where('users_id', $userId)
            ->where('id', $id)
            ->firstOrFail();

        return view('user.order.details', compact('order'));
    }
}
