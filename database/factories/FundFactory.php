<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fund>
 */
class FundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fund_id' =>  substr($this->faker->unique()->uuid, 0, 8),
            'created_by' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'feature_image' => $this->faker->imageUrl(),
            'current_balance' => $this->faker->randomFloat(2, 0, 100000),
        ];
    }
}
