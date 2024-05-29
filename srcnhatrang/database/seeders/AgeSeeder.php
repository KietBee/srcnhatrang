<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AgeSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ages')->insert([
            [
                'age_ID' => 'AG1430452705',
                'description' => 'Dưới 7 tháng tuổi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'age_ID' => 'AG1430472705',
                'description' => 'Từ 7 tháng đến 6 năm tuổi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'age_ID' => 'AG1430472705',
                'description' => 'Trên 6 năm tuổi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
