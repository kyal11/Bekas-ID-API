<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryList = [
            'Fesyen Wanita',
            'Fesyen Pria',
            'Kesehatan & Kecantikan',
            'Elektronik',
            'Telepon Seluler & Tablet',
            'Buku & Alat Tulis',
            'Bayi & Anak',
            'Olshop Fashion',
            'Barang Mewah',
            'Fotografi',
            'Video Game',
            'Makanan & Minuman',
            'Desain & Kerajinan Tangan',
            'Olah Raga',
            'Toys & Collectibles',
            'Antik',
            'Musik & Media',
            'Motor',
            'Mobil & Motor',
            'Aksesoris Mobil',
            'Properti',
            'Jasa',
            'Pekerjaan',
            'Perabotan Rumah',
            'Perkebunan',
            'Kitchen & Appliances',
            'Perlengkapan Hewan',
            'J-Pop',
            'K-Wave',
            'Tiket & Voucher',
            'Komunitas',
            'Serba Serbi',
        ];

        foreach ($categoryList as $category) {
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
    }
    
}
