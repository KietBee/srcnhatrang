<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pet;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetAdoptionRequest>
 */
class PetAdoptionRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_adoption_request_id' => substr($this->faker->unique()->uuid, 0, 8),
            'is_approval' => $this->faker->boolean(),
            'pet_id' => Pet::inRandomOrder()->first()->pet_id,
            'requester_id' => User::inRandomOrder()->first()->id,
            'approver_id' => User::inRandomOrder()->first()->id,
            'reason_for_adoption' => $this->faker->paragraph,
            'notes' => $this->faker->paragraph,
            'approved_at' => function (array $attributes) {
                return $attributes['is_approval'] ? $this->faker->dateTimeThisYear($max = 'now') : null;
            },
        ];        
    }
}
