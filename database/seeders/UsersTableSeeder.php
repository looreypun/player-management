<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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

        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('administrator'), // You can set a default password here
                'age' => $faker->date('Y-m-d', '2000-01-01'), // Random date of birth
                'phone' => $faker->phoneNumber,
                'img_url' => $faker->imageUrl(200, 200, 'people', true),
                'position_id' => rand(1, 4), // You can set a default position ID here
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
