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
                'specie_id' => 'SPCH0406',
                'specie_name' => 'chó',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'SPME0406',
                'specie_name' => 'mèo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'SPCI0406',
                'specie_name' => 'chim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'SPTO0406',
                'specie_name' => 'thỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'specie_id' => 'ATSM0406',
                'specie_name' => 'động vật nhỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
