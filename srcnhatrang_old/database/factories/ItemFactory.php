<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ItemType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => substr($this->faker->unique()->uuid, 0, 8),
            'item_type_id' => ItemType::inRandomOrder()->first()->item_type_id,
            'item_name' => $this->faker->word,
            'item_description' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}
