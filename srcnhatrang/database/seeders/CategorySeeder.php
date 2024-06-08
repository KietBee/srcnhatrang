<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'category_id' => 'CG0000000000',
                'category_name' => 'Tin tức',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 'CG1530522705',
                'category_name' => 'Câu chuyện nhỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 'CG1630522705',
                'category_name' => 'Mẹo chăm thú cưng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }  
}
