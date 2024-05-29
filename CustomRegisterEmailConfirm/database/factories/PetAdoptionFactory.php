<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pet;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetAdoption>
 */
class PetAdoptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_adoption_id' => substr($this->faker->unique()->uuid, 0, 8),
            'pet_id' => Pet::inRandomOrder()->first()->pet_id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
