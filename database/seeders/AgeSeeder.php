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
        $date = Carbon::now()->format('dm');
        DB::table('ages')->insert([
            [
                'age_ID' => 'AGYO'. $date,
                'description' => 'Young',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'age_ID' => 'AGAD'. $date,
                'description' => 'Adult',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'age_ID' => 'AGSE'. $date,
                'description' => 'Senior',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'age_ID' => 'AGPU'. $date,
                'description' => 'Puppy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
