<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sizes')->insert([
            [
                'size_id' => 'SZ'.rand(10000000, 99999999),
                'description' => 'Nhỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 'SZ'.rand(10000000, 99999999),
                'description' => 'Trung bình',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 'SZ'.rand(10000000, 99999999),
                'description' => 'Lớn',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
