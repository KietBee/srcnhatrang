<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PrimaryColorSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->format('dm');
        DB::table('primary_colors')->insert([
            [
                'primary_color_ID' => 'PCBL'.$date,
                'primary_color_name' => 'Black',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_ID' => 'PCWH'.$date,
                'primary_color_name' => 'White',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_ID' => 'PCBR'.$date,
                'primary_color_name' => 'Brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_ID' => 'PCGR'.$date,
                'primary_color_name' => 'Grey',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primary_color_ID' => 'PCOR'.$date,
                'primary_color_name' => 'Orange',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
