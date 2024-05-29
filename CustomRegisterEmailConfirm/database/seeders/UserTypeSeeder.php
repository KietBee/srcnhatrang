<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_types')->insert([
            [
                'user_type_ID' => 'ATAD0406',
                'user_type_name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type_ID' => 'ATUS0406',
                'user_type_name' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
