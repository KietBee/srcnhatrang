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
class userFactory extends Factory
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
        return [
            'id' => substr($this->faker->unique()->uuid, 0, 8),
            'user_type_id' => UserType::inRandomOrder()->first()->user_type_id,
            'avatar' => $this->faker->imageUrl(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone_number' => $this->faker->phoneNumber,
            'address_id' => Ward::inRandomOrder()->first()->id,
            'address_description' => $this->faker->sentence,
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
