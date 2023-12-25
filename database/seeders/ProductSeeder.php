<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('products')->insert([
            [
                'user_id' => 2,
                'name' => 'Album The Beatles',
                'condition' => 'tidak terlalu sering digunakan',
                'price' => 500000,
                'description' => 'Album keluaran tahun 1980',
                'category_id' => 17,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Gitar Akustik Yamaha',
                'condition' => 'barang baru',
                'price' => 1500000,
                'description' => 'Gitar akustik berkualitas tinggi',
                'category_id' => 17,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Kamera Canon EOS',
                'condition' => 'sering digunakan',
                'price' => 3500000,
                'description' => 'Kamera DSLR Canon dengan lensa kit',
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Sepatu Nike Air Max',
                'condition' => 'barang baru',
                'price' => 800000,
                'description' => 'Sepatu olahraga dengan teknologi Air Max',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Buku Programming in PHP',
                'condition' => 'barang baru',
                'price' => 200000,
                'description' => 'Buku panduan pemrograman PHP',
                'category_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
