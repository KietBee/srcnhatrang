<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrimaryColorSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('primary_colors')->insert([
            [
                'primary_color_id' => 'PR'.rand(10000000, 99999999),
                'primary_color_name' => 'Đen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_id' => 'PR'.rand(10000000, 99999999),
                'primary_color_name' => 'Trắng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_id' => 'PR'.rand(10000000, 99999999),
                'primary_color_name' => 'Nâu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_id' => 'PR'.rand(10000000, 99999999),
                'primary_color_name' => 'Xám',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_id' => 'PR'.rand(10000000, 99999999),
                'primary_color_name' => 'Cam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
