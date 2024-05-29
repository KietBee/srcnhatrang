<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetImage>
 */
class PetImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_image_id' => substr($this->faker->unique()->uuid, 0, 8),
            'pet_id' => Pet::inRandomOrder()->first()->pet_id,
            'pet_image' => $this->faker->imageUrl(),
        ];
    }
}
