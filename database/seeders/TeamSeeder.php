<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            ['name' => 'Ohashi FC'],
            ['name' => 'Higashi FC'],
            ['name' => 'EV FC'],
            ['name' => 'Gurkha Brothers FC'],
            ['name' => 'Kurume FC'],
            ['name' => 'United FC'],
            ['name' => 'Gonin FC'],
        ]);
    }
}
