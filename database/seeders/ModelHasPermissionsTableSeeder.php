<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('model_has_permissions')->insert([
            ['model_type' => 'App\Models\User', 'model_id' => 1, 'permission_id' => 1],
        ]);
    }
}