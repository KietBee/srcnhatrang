<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SizeSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->format('dm');
        DB::table('sizes')->insert([
            [
                'size_ID' => 'SISM'. $date,
                'description' => 'Small',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_ID' => 'SIME'. $date,
                'description' => 'Medium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_ID' => 'SILA'. $date,
                'description' => 'Large',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
