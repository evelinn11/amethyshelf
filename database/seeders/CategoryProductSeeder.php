<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('category_product')->insert([
            // Produk 1: Sapiens: A Brief History of Humankind
            ['products_id' => 1, 'categories_id' => 1, 'created_at' => now(), 'updated_at' => now()], // ACADEMIC
            ['products_id' => 1, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            

            // Produk 2: Thinking, Fast and Slow
            ['products_id' => 2, 'categories_id' => 1, 'created_at' => now(), 'updated_at' => now()],  // ACADEMIC
            ['products_id' => 2, 'categories_id' => 10, 'created_at' => now(), 'updated_at' => now()],  // SELF HELP

            // Produk 3: Metodologi Penelitian Kualitatif
            ['products_id' => 3, 'categories_id' => 1, 'created_at' => now(), 'updated_at' => now()],  // ACADEMIC

            // Produk 4: Statistika untuk Penelitian
            ['products_id' => 4, 'categories_id' => 1, 'created_at' => now(), 'updated_at' => now()],  // ACADEMIC
            
            // Produk 5: Komunikasi Politik : Teori, Strategi, dan Penerapannya di Era Kontemporer
            ['products_id' => 5, 'categories_id' => 1, 'created_at' => now(), 'updated_at' => now()],  // ACADEMIC

            // Produk 6: The Origin of Species
            ['products_id' => 6, 'categories_id' => 1, 'created_at' => now(), 'updated_at' => now()],  // ACADEMIC
            ['products_id' => 6, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
            ['products_id' => 6, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL

            // Produk 7: Project PHP: Membangun Sistem Informasi Akademik Dengan Framework Codeigniter
            ['products_id' => 7, 'categories_id' => 1, 'created_at' => now(), 'updated_at' => now()],  // ACADEMIC

            // Produk 8: Instaxnesia: A Nation of Creative Expression
            ['products_id' => 8, 'categories_id' => 2, 'created_at' => now(), 'updated_at' => now()],  // ART & PHOTOGRAPHY

            // Produk 9: Art Girl Setsuko Negishi dan Kawan-Kawannya
            ['products_id' => 9, 'categories_id' => 2, 'created_at' => now(), 'updated_at' => now()],  // ART & PHOTOGRAPHY
            ['products_id' => 9, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC

            // Produk 10: Doodle Art And Typography #1
            ['products_id' => 10, 'categories_id' => 2, 'created_at' => now(), 'updated_at' => now()],  // ART & PHOTOGRAPHY
            
            // Produk 11: Dardanella: Perintis Teater Indonesia Modern, Duta Kesenian Indonesia Melanglang Buana
            ['products_id' => 11, 'categories_id' => 2, 'created_at' => now(), 'updated_at' => now()],  // ART & PHOTOGRAPHY
            ['products_id' => 11, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY

            // Produk 12: Art Of Terrarium: Keindahan Taman Dalam Kaca
            ['products_id' => 12, 'categories_id' => 2, 'created_at' => now(), 'updated_at' => now()],  // ART & PHOTOGRAPHY

            // Produk 13: 7 Hari Belajar Drone Photography (Edisi Revisi)
            ['products_id' => 13, 'categories_id' => 2, 'created_at' => now(), 'updated_at' => now()],  // ART & PHOTOGRAPHY
            
            // Produk 14: Drawing Dreams, Start with a Circle
            ['products_id' => 14, 'categories_id' => 2, 'created_at' => now(), 'updated_at' => now()],  // ART & PHOTOGRAPHY
            
            // Produk 15: Online to Offline, Offline to Online
            ['products_id' => 15, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            
            // Produk 16: Digital Marketing Blueprint
            ['products_id' => 16, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            
            // Produk 17: The Power of Crazy Affiliate
            ['products_id' => 17, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            
            // Produk 18: Etika Bisnis
            ['products_id' => 18, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            
            // Produk 19: Mindfulness-Based Business (English Edition)
            ['products_id' => 19, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            ['products_id' => 19, 'categories_id' => 10, 'created_at' => now(), 'updated_at' => now()],  // SELF HELP

            // Produk 20: Panduan Perdagangan Ekspor Impor
            ['products_id' => 20, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            
            // Produk 21: Talking to My Daughter About the Economy 2025
            ['products_id' => 21, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            ['products_id' => 21, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL

            // Produk 22: Attack on Titan 24
            ['products_id' => 22, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
           
            // Produk 23: Blue Lock - Episode Nagi vol. 04
            ['products_id' => 23, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
             
            // Produk 24: Hai, Miiko! 35 - Bookpaper
            ['products_id' => 24, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
           
            // Produk 25: Dandadan 03
            ['products_id' => 25, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
             
            // Produk 26: Hai, Miiko! 18 - Bookpaper
            ['products_id' => 26, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
           
            // Produk 27: Friendzone Vol.1
            ['products_id' => 27, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
            ['products_id' => 27, 'categories_id' => 9, 'created_at' => now(), 'updated_at' => now()],  // ROMANCE
           
            // Produk 28: Yotsuba &! 15
            ['products_id' => 28, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
           
            // Produk 29: Arsitektur Rumah Jawa : Mengungkap Filosofi Makna dan Simbologinya
            ['products_id' => 29, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
           
            // Produk 30: Filosofi Rumah Tradisional Jawa
            ['products_id' => 30, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
           
            // Produk 31: Petualangan Marco Polo
            ['products_id' => 31, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
           
            // Produk 32: Merawat Kehidupan – 100 Tahun Rumah Sakit Husada (Jang Seng Ie)
            ['products_id' => 32, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
           
            // Produk 33: Little People Big Dreams: Maria Montessori
            ['products_id' => 33, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
            ['products_id' => 33, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
           
            // Produk 34: Little Women (Republish 2025)
            ['products_id' => 34, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
            ['products_id' => 34, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
           
            // Produk 35: Shogun Jilid 2
            ['products_id' => 35, 'categories_id' => 6, 'created_at' => now(), 'updated_at' => now()],  // HISTORY
            ['products_id' => 35, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
           
            // Produk 36: Koleksi Humor Gus Dur Paling Nyeleneh
            ['products_id' => 36, 'categories_id' => 5, 'created_at' => now(), 'updated_at' => now()],  // COMEDY
           
            // Produk 37: Prisma: Humor Yang Adil & Beradab
            ['products_id' => 37, 'categories_id' => 5, 'created_at' => now(), 'updated_at' => now()],  // COMEDY
           
            // Produk 38: Jomblo: sebuah komedi cinta
            ['products_id' => 38, 'categories_id' => 5, 'created_at' => now(), 'updated_at' => now()],  // COMEDY
            ['products_id' => 38, 'categories_id' => 9, 'created_at' => now(), 'updated_at' => now()],  // ROMANCE
           
            // Produk 39: My Youth Romantic Comedy Is Wrong As I Expected @Comic 5
            ['products_id' => 39, 'categories_id' => 5, 'created_at' => now(), 'updated_at' => now()],  // COMEDY
            ['products_id' => 39, 'categories_id' => 4, 'created_at' => now(), 'updated_at' => now()],  // COMIC
            ['products_id' => 39, 'categories_id' => 9, 'created_at' => now(), 'updated_at' => now()],  // ROMANCE
           
            // Produk 40: Hyperbole and a Half
            ['products_id' => 40, 'categories_id' => 5, 'created_at' => now(), 'updated_at' => now()],  // COMEDY
           
            // Produk 41: Ubur-Ubur Lembur
            ['products_id' => 41, 'categories_id' => 5, 'created_at' => now(), 'updated_at' => now()],  // COMEDY
           
            // Produk 42: SkripSick: Derita Mahasiswa Abadi
            ['products_id' => 42, 'categories_id' => 5, 'created_at' => now(), 'updated_at' => now()],  // COMEDY
           
            // Produk 43: Hati yang Berani, Sahabat Sejati
            ['products_id' => 43, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 43, 'categories_id' => 9, 'created_at' => now(), 'updated_at' => now()],  // ROMANCE
           
            // Produk 44: Nikola Maldini
            ['products_id' => 44, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 44, 'categories_id' => 9, 'created_at' => now(), 'updated_at' => now()],  // ROMANCE
           
            // Produk 45: Anne of Avonlea
            ['products_id' => 45, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 45, 'categories_id' => 9, 'created_at' => now(), 'updated_at' => now()],  // ROMANCE
            
            // Produk 46: The Psychology of Money Edisi Revisi
            ['products_id' => 46, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 46, 'categories_id' => 3, 'created_at' => now(), 'updated_at' => now()],  // BUSINESS
            ['products_id' => 46, 'categories_id' => 10, 'created_at' => now(), 'updated_at' => now()],  // SELF IMPROVEMENT
            
            // Produk 47: Positivity Power
            ['products_id' => 47, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 47, 'categories_id' => 10, 'created_at' => now(), 'updated_at' => now()],  // SELF HELP
            
            // Produk 48: The Magic of Luck
            ['products_id' => 48, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 48, 'categories_id' => 10, 'created_at' => now(), 'updated_at' => now()],  // SELF HELP
            
            // Produk 49: Berpikir dan Bertindak Besar
            ['products_id' => 49, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 49, 'categories_id' => 10, 'created_at' => now(), 'updated_at' => now()],  // SELF HELP
            
            // Produk 50: Harry Potter
            ['products_id' => 50, 'categories_id' => 7, 'created_at' => now(), 'updated_at' => now()],  // NOVEL
            ['products_id' => 50, 'categories_id' => 11, 'created_at' => now(), 'updated_at' => now()],  // FICTION
            
        ]);
    }
}
