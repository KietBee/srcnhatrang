<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredefinedMonthlyAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amounts = [
            [
                'amount' => 30000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'amount' => 40000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'amount' => 80000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'amount' => 90000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('predefined_monthly_amounts')->insert($amounts);
    }
}
