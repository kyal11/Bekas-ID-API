<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Admin'),
                'phone_number' => '083812721450',
                'role_id' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Seller',
                'email' => 'seller@gmail.com',
                'password' => bcrypt('seller'),
                'phone_number' => '083812721451',
                'role_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('customer'),
                'phone_number' => '083812721452',
                'role_id' => 2,
                'created_at' => now()
            ]
        ]);
    }
}
