<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('transactions')->insert([
            [
                'users_id' => 2,
                'payment_method' => 'QRIS',
                'total_amount' => 150000.00,
                'order_status' => 'completed',
                'payment_url' => null,                
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'users_id' => 2,
                'payment_method' => 'Bank Transfer',
                'total_amount' => 199000.00,
                'order_status' => 'completed',
                'payment_url' => null,                
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'users_id' => 2,
                'payment_method' => null,
                'total_amount' => 98000.00,
                'order_status' => 'cancelled',
                'payment_url' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ]
        ]);
    }
}
