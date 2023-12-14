<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('offers')->insert([
            [
                'user_id' => 3,
                'seller_id' => 2,
                'product_id' => 1,
                'price' => 450000,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'seller_id' => 2,
                'product_id' => 2,
                'price' => 1400000,
                'status' => 'accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'seller_id' => 2,
                'product_id' => 3,
                'price' => 3300000,
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'seller_id' => 2,
                'product_id' => 4,
                'price' => 750000,
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'seller_id' => 2,
                'product_id' => 5,
                'price' => 180000,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
