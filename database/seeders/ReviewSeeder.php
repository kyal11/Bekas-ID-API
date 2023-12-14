<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('reviews')->insert([
            [
                'user_id' => 3,
                'seller_id' => 2,
                'product_id' => 2,
                'review' => 'Sellernya amanah,barang bagus dan terjamin',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
