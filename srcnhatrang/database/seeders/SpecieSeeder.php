<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecieSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('species')->insert([
            [
                'specie_id' => 'SP1430472705',
                'specie_name' => 'Chó',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'SP1430482705',
                'specie_name' => 'Mèo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'SP1430502705',
                'specie_name' => 'Chim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'SP1530502705',
                'specie_name' => 'Thỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'SP1630502705',
                'specie_name' => 'động vật nhỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
