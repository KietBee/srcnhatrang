<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\ItemDonation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailItemDonation>
 */
class DetailItemDonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_donation_id' => ItemDonation::inRandomOrder()->first()->item_donation_id,
            'item_id' => Item::inRandomOrder()->first()->item_id,
            'amount' => $this->faker->randomNumber($min = 1),
        ];
    }
}
