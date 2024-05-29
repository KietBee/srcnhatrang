<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PrimaryColor;
use App\Models\Size;
use App\Models\Age;
use App\Models\Breed;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_id' => substr($this->faker->unique()->uuid, 0, 8),
            'primary_color_id' => PrimaryColor::inRandomOrder()->first()->primary_color_id,
            'age_id' => Age::inRandomOrder()->first()->age_id,
            'size_id' => Size::inRandomOrder()->first()->size_id,
            'breed_id' => Breed::inRandomOrder()->first()->breed_id,
            'pet_name' => $this->faker->name,
            'gender' => $this->faker->randomElement([true, false]),
            'description' => $this->faker->sentence,
            'health_status' => $this->faker->word,
            'rescued_at' => $this->faker->dateTimeThisYear($max = 'now'),
        ];
    }
}
