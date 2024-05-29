<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Item;
use App\Models\DeliveryMethod;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemDonation>
 */
class ItemDonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_donation_id' => substr($this->faker->unique()->uuid, 0, 8),
            'donor_id' => User::inRandomOrder()->first()->id,
            'item_id' => Item::inRandomOrder()->first()->item_id,
            'status' => $this->faker->boolean,
            'approver_id' => function (array $attributes) {
                return $attributes['status'] ? User::inRandomOrder()->first()->id : null;
            },
            'approved_at' => function (array $attributes) {
                return $attributes['status'] ? $this->faker->dateTimeThisYear($max = 'now') : null;
            },
            'delivery_method_id' => DeliveryMethod::inRandomOrder()->first()->delivery_method_id,
            'quantity' => $this->faker->randomNumber($min = 1),
        ];
    }
}
