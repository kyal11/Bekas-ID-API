<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('user_roles')->insert([
            [
                'role_name' => 'Admin',
                'abilities' => '[*]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Member',
                'abilities' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}