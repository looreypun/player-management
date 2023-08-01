<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'redzone', 'email' => 'redzone.dev@gmail.com', 'password' => Hash::make('administrator'), 'img_url' => 'https://images.pexels.com/photos/11608681/pexels-photo-11608681.jpeg?auto=compress&cs=tinysrgb&w=1600', 'age' => '1995-05-16', 'position_id' => 2, 'phone' => '08076504242', 'created_at' => '2023-07-25 03:06:47', 'updated_at' => '2023-07-25 03:06:47'],
        ]);

        $client = new Client([
            'verify' => false, // Disable SSL certificate verification
        ]);

        for ($i = 0; $i < 100; $i++) {
            // Make a request to the RandomUser.me API
            $response = $client->get('https://randomuser.me/api/?inc=name,email,dob,phone,picture');

            // Get the JSON response and decode it
            $data = json_decode($response->getBody(), true);
            $user = $data['results'][0];

            // Extract user data from the API response
            User::create([
                'name' => $user['name']['first'] . ' ' . $user['name']['last'],
                'email' => $user['email'],
                'email_verified_at' => now(),
                'password' => bcrypt('administrator'), // You can set a default password here
                'age' => date('Y-m-d', strtotime($user['dob']['date'])),
                'phone' => $user['phone'],
                'img_url' => $user['picture']['large'],
                'position_id' => $this->generatePositionId(), // You can set a default position ID here
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Generates a random position ID based on probability.
     * @return int The generated position ID.
     */
    private function generatePositionId(): int
    {
        // 20% chance of position_id being 1, 2, or 3 (rarely 1-3)
        if (rand(1, 100) <= 20) {
            return rand(1, 3);
        }

        // 10% chance of position_id being 4 or less (rarely 4)
        if (rand(1, 100) <= 10) {
            return rand(1, 4);
        }

        // 70% chance of position_id being 5 or more (normal distribution for higher position IDs)
        return rand(5, 7);
    }
}
