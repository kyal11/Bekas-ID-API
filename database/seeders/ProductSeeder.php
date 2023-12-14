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
                'condition' => 'bekas',
                'price' => 500000,
                'description' => 'Album keluaran tahun 1980',
                'category' => 'Musik',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Gitar Akustik Yamaha',
                'condition' => 'baru',
                'price' => 1500000,
                'description' => 'Gitar akustik berkualitas tinggi',
                'category' => 'Musik',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Kamera Canon EOS',
                'condition' => 'bekas',
                'price' => 3500000,
                'description' => 'Kamera DSLR Canon dengan lensa kit',
                'category' => 'Elektronik',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Sepatu Nike Air Max',
                'condition' => 'baru',
                'price' => 800000,
                'description' => 'Sepatu olahraga dengan teknologi Air Max',
                'category' => 'Fashion',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Buku Programming in PHP',
                'condition' => 'baru',
                'price' => 200000,
                'description' => 'Buku panduan pemrograman PHP',
                'category' => 'Buku',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
