<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            [
                'user_id' => 1,
                'context' => 'profile',
                'name_file_image' => 'admin.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'context' => 'profile',
                'name_file_image' => 'seller.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'context' => 'profile',
                'name_file_image' => 'customer.png',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('images')->insert([
            [
                'product_id' => 1,
                'context' => 'product',
                'name_file_image' => 'albumthebeatles.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'context' => 'product',
                'name_file_image' => 'gitarakustik.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'context' => 'product',
                'name_file_image' => 'canoneos.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 4,
                'context' => 'product',
                'name_file_image' => 'nikeairmax.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 5,
                'context' => 'product',
                'name_file_image' => 'bukuphp.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
