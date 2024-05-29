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
                'breed_id' => 'BR1430502705',
                'specie_id' => 'SP1430472705',
                'breed_name' => 'Bulldog',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1430522705',
                'specie_id' => 'SP1430472705',
                'breed_name' => 'Poodle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1430532705',
                'specie_id' => 'SP1430472705',
                'breed_name' => 'Labrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1430542705',
                'specie_id' => 'SP1430472705',
                'breed_name' => 'Golden Retriever',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1430552705',
                'specie_id' => 'SP1430472705',
                'breed_name' => 'German Shepherd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            [
                'breed_id' => 'BR1431502705',
                'specie_id' => 'SP1430482705',
                'breed_name' => 'Mướp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1432502705',
                'specie_id' => 'SP1430482705',
                'breed_name' => 'Ba Tư',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1433502705',
                'specie_id' => 'SP1430482705',
                'breed_name' => 'Maine Coon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1434502705',
                'specie_id' => 'SP1430482705',
                'breed_name' => 'Ragdoll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            [
                'breed_id' => 'BR1434702705',
                'specie_id' => 'SP1430502705',
                'breed_name' => 'Vẹt',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'breed_id' => 'BR1434802705',
                'specie_id' => 'SP1630502705',
                'breed_name' => 'Chuột Hamster',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1434902705',
                'specie_id' => 'SP1630502705',
                'breed_name' => 'Chuột Lang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'breed_id' => 'BR1454902705',
                'specie_id' => 'SP1630502705',
                'breed_name' => 'Thỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }    
}
