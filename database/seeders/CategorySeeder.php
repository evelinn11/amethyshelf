<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'categories_name' => 'Academic',
                'categories_description' => 'Novel adalah sebuah karya sastra prosa naratif yang panjang, biasanya diterbitkan dalam bentuk buku. Novel menceritakan tentang kehidupan tokoh, mulai dari lahir hingga mati, dan dapat menampilkan konflik, alur cerita, serta watak tokoh secara mendalam. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Art & Photography',
                'categories_description' => '"Art and photography" merujuk pada pemahaman bahwa fotografi dapat dianggap sebagai bentuk seni. Fotografi dapat digunakan untuk menciptakan karya seni visual yang memiliki nilai estetika dan dapat mengekspresikan ide, emosi, atau visi seniman. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Business',
                'categories_description' => ' Buku ini akan memberikan pengetahuan dasar dalam mempelajari dunia bisnis sehingga akan menjadi bekal yang sangat berharga untuk terus mendalami bisnis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Comic',
                'categories_description' => 'Komik adalah sebuah cerita yang disampaikan melalui serangkaian gambar yang saling berhubungan, yang dapat disertai dengan teks atau informasi visual lainnya. Komik biasanya memiliki bentuk rangkaian panel gambar, dan dapat mengandung elemen seperti balon ucapan, teks, dan onomatope untuk menggambarkan dialog, narasi, efek suara, atau informasi tambahan. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Comedy',
                'categories_description' => 'Komedi adalah sebuah karya yang lucu dan biasanya bertujuan untuk menghibur serta menimbulkan tawa. Komedi seringkali menampilkan cerita yang menyinggung kelemahan sifat manusia dengan cara yang lucu, sehingga dapat membuat pembaca lebih menghayati kenyataan hidup. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'History',
                'categories_description' => 'Sejarah adalah studi tentang masa lampau manusia, meliputi peristiwa, perubahan, dan perkembangan masyarakat. Ini adalah catatan tentang kejadian-kejadian yang benar-benar terjadi di masa lalu, yang dipelajari secara sistematis untuk memahami dinamika kehidupan manusia dan peradaban. Sejarah mencakup berbagai aspek, mulai dari peristiwa politik, ekonomi, sosial, hingga budaya, dan teknologi. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Novel',
                'categories_description' => 'Novel adalah sebuah karya sastra prosa naratif yang panjang, biasanya diterbitkan dalam bentuk buku. Novel menceritakan tentang kehidupan tokoh, mulai dari lahir hingga mati, dan dapat menampilkan konflik, alur cerita, serta watak tokoh secara mendalam. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Science Fiction',
                'categories_description' => 'Fiksi ilmiah (sci-fi) adalah genre fiksi spekulatif yang menggambarkan pengaruh sains dan teknologi terhadap masyarakat dan individu, seringkali dengan latar belakang masa depan, luar angkasa, atau dunia alternatif. Genre ini seringkali melibatkan konsep-konsep imajinatif seperti teknologi canggih, eksplorasi ruang angkasa, perjalanan waktu, dan kehidupan alien. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Romance',
                'categories_description' => 'Genre romance adalah genre karya sastra (puisi atau prosa) yang berfokus pada hubungan romantis, cinta, dan idealisme, seringkali dengan akhir yang memuaskan secara emosional. Genre ini umumnya menampilkan kisah percintaan antara dua tokoh, dengan penekanan pada gairah, keintiman, dan konflik yang timbul dari hubungan mereka. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Self Help',
                'categories_description' => 'Genre "self help" (buku pengembangan diri) adalah kategori buku non-fiksi yang bertujuan untuk membantu pembaca mengatasi masalah atau meningkatkan berbagai aspek kehidupan mereka. Buku-buku ini biasanya menawarkan saran, strategi, atau panduan praktis untuk mencapai tujuan pribadi atau profesional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_name' => 'Fiction',
                'categories_description' => 'Genre fiksi adalah kategori atau jenis karya sastra yang diciptakan dari imajinasi, bukan berdasarkan fakta atau kejadian nyata. Karya fiksi meliputi novel, cerita pendek, dan novela, serta berbagai sub-genre seperti fiksi ilmiah, fantasi, horor, dan drama.',
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
