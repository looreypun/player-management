<?php

namespace Database\Seeders;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use JsonException;
use Exception;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function run(): void
    {
        $faker = Faker::create();
        $client = new Client();
        $usersData = [];

        $admin = [
            'name' => 'redzone',
            'email' => 'redzone.dev@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('administrator'),
            'age' => '1995-05-16',
            'phone' => '08076504242',
            'img_url' => 'https://images.pexels.com/photos/11608681/pexels-photo-11608681.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'position_id' => 2,
            'desc' => 'I am a manager of HF',
            'remember_token' => Str::random(10)
        ];
        $usersData[] = $admin;

        for ($i = 0; $i < 30; $i++) {
            $response = $client->get('https://randomuser.me/api/?inc=name,email,dob,phone,picture');
            $data = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            $user = $data['results'][0];

            $members = [
                'name' => $user['name']['first'] . ' ' . $user['name']['last'],
                'email' => $user['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('administrator'), // You can set a default password here
                'age' => date('Y-m-d', strtotime($user['dob']['date'])),
                'phone' => $user['phone'],
                'img_url' => $user['picture']['large'],
                'position_id' => $this->generatePositionId(), // You can set a default position ID here
                'desc' => $faker->sentence(10),
                'remember_token' => Str::random(10)
            ];

            $usersData[] = $members;
        }
        User::insert($usersData);
    }

    /**
     * Generates a random position ID based on probability.
     * @return int The generated position ID.
     * @throws Exception
     */
    private function generatePositionId(): int
    {
        // 20% chance of position_id being 1, 2, or 3 (rarely 1-3)
        if (random_int(1, 100) <= 20) {
            return random_int(1, 3);
        }

        // 10% chance of position_id being 4 or less (rarely 4)
        if (random_int(1, 100) <= 10) {
            return random_int(1, 4);
        }

        // 70% chance of position_id being 5 or more (normal distribution for higher position IDs)
        return random_int(5, 7);
    }
}
