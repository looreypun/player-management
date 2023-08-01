<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contribution;
use Faker\Factory as Faker;

class ContributionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            // Generating random timestamps for the current year
            $startDate = $faker->dateTimeThisYear;
            $endDate = $faker->dateTimeBetween($startDate, 'now');

            Contribution::create([
                'name' => $faker->name,
                'amount' => $faker->randomFloat(2, 100, 10000),
                'memo' => $faker->sentence,
                'created_at' => $startDate,
                'updated_at' => $endDate,
            ]);
        }
    }
}
