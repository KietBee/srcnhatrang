<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'story_ID' => substr($this->faker->unique()->uuid, 0, 8),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'feature_image_url' => $this->faker->imageUrl(),
            'author_ID' => User::inRandomOrder()->first()->id,
            'is_approved' => $this->faker->boolean(),
            'approver_Id' => function (array $attributes) {
                return $attributes['is_approved'] ? User::where('user_type_ID', 'like', '%ATAD%')->first()->id : null;
            },
            'approved_at' => function (array $attributes) {
                return $attributes['is_approved'] ?  $this->faker->dateTimeThisYear($max = 'now') : null;
            },
            'is_edited' => $this->faker->boolean(),
            'edited_at' => function (array $attributes) {
                return $attributes['is_edited'] ? $this->faker->dateTimeThisYear($max = 'now') : null;
            },
        ];
    }
}
