<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredefinedOnlyAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amounts = [
            [
                'amount' => 15000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'amount' => 20000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'amount' => 40000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'amount' => 45000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('predefined_only_amounts')->insert($amounts);
    }
}
