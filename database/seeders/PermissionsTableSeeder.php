<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['id' => 1, 'name' => 'ADMIN', 'guard_name' => 'web', 'created_at' => '2023-07-25 03:52:42', 'updated_at' => '2023-07-25 03:52:42'],
            ['id' => 2, 'name' => 'USER', 'guard_name' => 'web', 'created_at' => '2023-07-25 03:52:59', 'updated_at' => '2023-07-25 03:52:59'],
        ]);
    }
}
