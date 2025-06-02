<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('users')->insert([
            [
                'name' => 'Evelyn Komalasari',
                'password' => '$2y$10$Z5kR0eGqHaWKP2EBQRC9iOHx3qQXVcxz9rG9GQ3HgMzjKFLXHQUd6', //bcrypt evelynkh
                'role' => 'U',
                'address' => 'Jl. Melati',                
                'email' => 'evelynkaha@gmail.com',
                'phone_number' => '081324543532',
                'status_del' => 0,           
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'name' => 'Celin Anindya',
                'password' => '$2y$10$2QHR.FZ.0XGbVEOxJuXWceva.WpnLpCpCGW4Fz8Tjq4dwnHGvSOqG', // bcrypt "celin123"
                'role' => 'U',
                'address' => 'Jl. Anggrek',
                'email' => 'celin.anindya@example.com',
                'phone_number' => '081212345678',
                'status_del' => 0,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ]
        ]);
    }
}
