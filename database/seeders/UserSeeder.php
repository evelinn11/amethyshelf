<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            // [
            //     'name' => 'Evelyn Komalasari',
            //     'password' => '$2y$10$Z5kR0eGqHaWKP2EBQRC9iOHx3qQXVcxz9rG9GQ3HgMzjKFLXHQUd6', //bcrypt evelynkh
            //     'role' => 'U',
            //     'address' => 'Jl. Melati',                
            //     'email' => 'evelynkaha@gmail.com',
            //     'phone_number' => '081324543532',
            //     'status_del' => 0,           
            //     'created_at' => now()->subDays(8),
            //     'updated_at' => now()->subDays(8),
            // ],
            // [
            //     'name' => 'Celin Anindya',
            //     'password' => '$2y$10$2QHR.FZ.0XGbVEOxJuXWceva.WpnLpCpCGW4Fz8Tjq4dwnHGvSOqG', // bcrypt "celin123"
            //     'role' => 'U',
            //     'address' => 'Jl. Anggrek',
            //     'email' => 'celin.anindya@example.com',
            //     'phone_number' => '081212345678',
            //     'status_del' => 0,
            //     'created_at' => now()->subDays(10),
            //     'updated_at' => now()->subDays(10),
            // ],
            // [
            //     'name' => 'Varrel Tjandra',
            //     'password' => Hash::make('varrel123'), 
            //     'role' => 'U',
            //     'address' => 'Jl. Mawar',
            //     'email' => 'tjandravarrel@gmail.com',
            //     'phone_number' => '08155150862',
            //     'status_del' => 0,
            //     'created_at' => now()->subDays(10),
            //     'updated_at' => now()->subDays(10),
            // ]
            // [
            //     'name' => 'Arthur',
            //     'password' => Hash::make('arthur123'), 
            //     'role' => 'U',
            //     'address' => 'Jl. Merpati',
            //     'email' => 'arthur@gmail.com',
            //     'phone_number' => '08155150861',
            //     'status_del' => 0,
            //     'created_at' => now()->subDays(10),
            //     'updated_at' => now()->subDays(10),
            // ]
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('admin123'), 
                'role' => 'A',
                'address' => 'Jl. Merpati',
                'email' => 'admin@admin.com',
                'phone_number' => '08155150860',
                'status_del' => 0,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ]
        ]);
    }
}
