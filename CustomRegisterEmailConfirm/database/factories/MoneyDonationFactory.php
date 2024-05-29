<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fund;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MoneyDonation>
 */
class MoneyDonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'money_donation_id' => substr($this->faker->unique()->uuid, 0, 8),
            'donor_id' => User::inRandomOrder()->first()->id,
            'fund_id' => Fund::inRandomOrder()->first()->fund_id,
            'frequency' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
