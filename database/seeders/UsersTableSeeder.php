<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'redzone', 'email' => 'redzone.dev@gmail.com', 'password' => Hash::make('administrator'), 'created_at' => '2023-07-25 03:06:47', 'updated_at' => '2023-07-25 03:06:47'],
        ]);
    }
}