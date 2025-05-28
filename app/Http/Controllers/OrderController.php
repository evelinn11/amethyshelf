<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function show(){
        $userRoles = ['customer'];
        $orders = collect([
            (object)[
                'transactions_id' => 'T20250427011',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => 'qris',
                'transactions_total_amount' => 150000,
                'transactions_order_status' => 'completed',
                'payment_url' => null,
                'created_at' => '2025-04-27 15:30:00',
                'updated_at' => '2025-04-27 15:30:00',
            ],
            (object)[
                'transactions_id' => 'T20250427012',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => 'transfer bank',
                'transactions_total_amount' => 360000.00,
                'transactions_order_status' => 'in delivery',
                'transactions_status_del' => 0,
                'payment_url' => null,
                'created_at' => '2025-05-02 10:30:00',
                'updated_at' => '2025-05-02 10:30:00',
            ],
            (object)[
                'transactions_id' => 'T20250427013',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => null,
                'transactions_total_amount' => 190000.00,
                'transactions_order_status' => 'pending',
                'transactions_status_del' => 0,
                'payment_url' => 'https://example.com/pay',
                'created_at' => '2025-05-10 21:42:00',
                'updated_at' => '2025-05-10 21:42:00',
            ],
                    (object)[
                'transactions_id' => 'T20250427014',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => 'BCA VA',
                'transactions_total_amount' => 490000.00,
                'transactions_order_status' => 'cancelled',
                'transactions_status_del' => 0,
                'payment_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        return view('user.orders', compact('orders', 'userRoles'));
    }

    public function details($id){
        $orders = collect([
            (object)[
                'transactions_id' => 'T20250427011',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => 'qris',
                'transactions_total_amount' => 150000,
                'transactions_order_status' => 'completed',
                'payment_url' => null,
                'created_at' => '2025-04-27 15:30:00',
                'updated_at' => '2025-04-27 15:30:00',
            ],
            (object)[
                'transactions_id' => 'T20250427012',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => 'transfer bank',
                'transactions_total_amount' => 360000.00,
                'transactions_order_status' => 'in delivery',
                'transactions_status_del' => 0,
                'payment_url' => null,
                'created_at' => '2025-05-02 10:30:00',
                'updated_at' => '2025-05-02 10:30:00',
            ],
            (object)[
                'transactions_id' => 'T20250427013',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => null,
                'transactions_total_amount' => 190000.00,
                'transactions_order_status' => 'pending',
                'transactions_status_del' => 0,
                'payment_url' => 'https://example.com/pay',
                'created_at' => '2025-05-10 21:42:00',
                'updated_at' => '2025-05-10 21:42:00',
            ],
            (object)[
                'transactions_id' => 'T20250427014',
                'myusers_id' => 'CJ001',
                'transactions_payment_method' => 'BCA VA',
                'transactions_total_amount' => 490000.00,
                'transactions_order_status' => 'cancelled',
                'transactions_status_del' => 0,
                'payment_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $allOrderDetails = collect([
            (object)[
                'transactions_id' => 'T20250427011',
                'products_name' => 'Atomic Habits',
                'products_image'=> '/images/atomic-habits.jpg',
                'transaction_details_qty' => 1,
                'transaction_details_unit_price' => 150000.00,
                'transaction_details_subtotal' => 150000.00,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            (object)[
                'transactions_id' => 'T20250427012',
                'products_name' => 'Laskar Pelangi',
                'products_image'=> '/images/laskar-pelangi.jpg',
                'transaction_details_qty' => 3,
                'transaction_details_unit_price' => 120000.00,
                'transaction_details_subtotal' => 360000.00,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            (object)[
                'transactions_id' => 'T20250427013',
                'products_name' => 'Tentang Kamu',
                'products_image'=> '/images/tentang-kamu.jpg',
                'transaction_details_qty' => 1,
                'transaction_details_unit_price' => 190000.00,
                'transaction_details_subtotal' => 190000.00,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            (object)[
                'transactions_id' => 'T20250427014',
                'products_name' => 'Atomic Habits',
                'products_image'=> '/images/atomic-habits.jpg',
                'transaction_details_qty' => 2,
                'transaction_details_unit_price' => 150000.00,
                'transaction_details_subtotal' => 300000.00,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            (object)[
                'transactions_id' => 'T20250427014',
                'products_name' => 'Tentang Kamu',
                'products_image'=> '/images/tentang-kamu.jpg',
                'transaction_details_qty' => 1,
                'transaction_details_unit_price' => 190000.00,
                'transaction_details_subtotal' => 190000.00,
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);

        $orders = $orders->firstWhere('transactions_id', $id);

        $order = $allOrderDetails->filter(function($item) use ($id) {
            return $item->transactions_id === $id;
        })->values();

        return view('user.order.details', compact('orders', 'order'));
    }
}
