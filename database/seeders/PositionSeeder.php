<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            ['name' => 'Leader'],
            ['name' => 'Manager'],
            ['name' => 'Sponsor'],
            ['name' => 'Goalkeeper'],
            ['name' => 'Defender'],
            ['name' => 'Midfielder'],
            ['name' => 'Forward'],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
