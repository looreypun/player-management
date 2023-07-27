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
            ['id' => 1, 'name' => 'redzone', 'email' => 'redzone.dev@gmail.com', 'password' => Hash::make('administrator'), 'img_url' => 'https://www.pngitem.com/pimgs/m/247-2472306_admin-anonymous-person-icon-hd-png-download.png', 'age' => '1995-05-16', 'position_id' => 2, 'phone' => '08076504242', 'created_at' => '2023-07-25 03:06:47', 'updated_at' => '2023-07-25 03:06:47'],
        ]);
    }
}
