<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class OrderController extends Controller
{
    public function show()
    {
        $userId = '2'; //masih hardcode, nanti setelah ada auth baru bisa
        $orders = Transaction::where('users_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders', compact('orders'));
    }

    public function details($id)
    {
        $userId = '2'; //masih hardcode, nanti setelah ada auth baru bisa

        $order = Transaction::with(['details.product.primaryImage'])
            ->where('users_id', $userId)
            ->where('id', $id)
            ->firstOrFail();

        return view('user.order.details', compact('order'));
    }
}
