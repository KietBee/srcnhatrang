<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreedSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('breeds')->insert([
            [
                'breed_id' => 'CHPD0406',
                'specie_id' => 'SPCH0406',
                'breed_name' => 'Bulldog',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'MEMU0406',
                'specie_id' => 'SPME0406',
                'breed_name' => 'Mướp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'CIVE0406',
                'specie_id' => 'SPCI0406',
                'breed_name' => 'vẹt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'SMHT0406',
                'specie_id' => 'ATSM0406',
                'breed_name' => 'Chuột Hamster',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'SMLA0406',
                'specie_id' => 'ATSM0406',
                'breed_name' => 'Chuột Lang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
