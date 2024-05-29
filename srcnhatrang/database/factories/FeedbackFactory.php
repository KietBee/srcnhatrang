<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'feedback_id' => substr($this->faker->unique()->uuid, 0, 8),
            'sender' => User::inRandomOrder()->first()->id,
            'content' => $this->faker->paragraph,
            'is_responded' => $this->faker->boolean(),
            'responder' => function (array $attributes) {
                return $attributes['is_responded'] ? User::inRandomOrder()->first()->id : null;
            },
            'response' => function (array $attributes) {
                return $attributes['is_responded'] ? $this->faker->paragraph : null;
            },
            'responded_at' => function (array $attributes) {
                return $attributes['is_responded'] ? $this->faker->dateTimeThisYear($max = 'now') : null;
            },
        ];
    }
}
