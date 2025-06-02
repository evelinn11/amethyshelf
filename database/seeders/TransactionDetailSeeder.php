<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('transaction_details')->insert([
            [
                'transaction_id' => 1,
                'product_id' => 3,
                'quantity' => 2,
                'unit_price' => 150000.00,
                'subtotal' => 300000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 1,
                'product_id' => 5,
                'quantity' => 1,
                'unit_price' => 150000.00,
                'subtotal' => 150000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 2,
                'product_id' => 41,
                'quantity' => 1,
                'unit_price' => 69000.00,
                'subtotal' => 69000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'transaction_id' => 2,
                'product_id' => 47,
                'quantity' => 2,
                'unit_price' => 65000.00,
                'subtotal' => 130000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 3,
                'product_id' => 2,
                'quantity' => 1,
                'unit_price' => 98000.00,
                'subtotal' => 98000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
