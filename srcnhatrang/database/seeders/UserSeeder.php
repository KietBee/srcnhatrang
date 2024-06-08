<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Ward;
use App\Models\User;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->times(30)->create();
        DB::table('users')->insert([
            [
                'id' => 'US00000000',
                'user_type_id' => 'ATAD0406',
                'avatar' => 'user.jpg',
                'first_name' => 'Kiệt',
                'last_name' => 'Nguyễn',
                'email' => 'kiet.nt.62cntt@ntu.edu.vn',
                'email_verified_at' => now(),
                'phone_number' => '0123435778',
                'address_id' => Ward::inRandomOrder()->first()->id,
                'address_description' => '',
                'password' => Hash::make("12345678"),
                'remember_token' => Str::random(10),
                'login_at' => now(),
                'change_password_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
