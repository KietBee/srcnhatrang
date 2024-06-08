<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\UserType;
use App\Models\Ward;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Set the locale to Vietnamese
        $faker = \Faker\Factory::create('vi_VN');

        return [
            'id' => 'US'.rand(10000000, 99999999),
            'user_type_id' => UserType::inRandomOrder()->first()->user_type_id,
            'avatar' => 'user.jpg',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone_number' => $faker->unique()->phoneNumber,
            'address_id' => Ward::inRandomOrder()->first()->id,
            'address_description' => $faker->address,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'login_at' => now(),
            'change_password_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
