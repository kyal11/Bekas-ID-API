<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        // Seeder untuk status 'pending'
        DB::table('chats')->insert([
            [
                'user_id' => 3,
                'seller_id' => 2,
                'offer_id' => 1,
                'sender_type' => 'user',
                'chat' => 'Apakah barang memiliki kekurangan mas ?',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'seller_id' => 2,
                'offer_id' => 1,
                'sender_type' => 'seller',
                'chat' => 'Barang ini dalam kondisi baik, tidak ada kekurangan.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'seller_id' => 2,
                'offer_id' => 1,
                'sender_type' => 'user',
                'chat' => 'Oke baik saya akan membelinya',
                'created_at' => now(),
                'updated_at' => now()
            ],
           
        ]);
    }
}
