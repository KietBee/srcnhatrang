<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fund;
use App\Models\User;
use Illuminate\Support\Carbon;

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
        $now = Carbon::now();
        $randomMonth = rand(0, $now->month - 1);
        return [
            'money_donation_id' => 'MD' . rand(10000000, 99999999),
            'donor_id' => User::inRandomOrder()->first()->id,
            'fund_id' => Fund::inRandomOrder()->first()->fund_id,
            'frequency' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
            'amount' => $this->faker->randomFloat(2, 100000, 10000000),
            'created_at' => $now->copy()->subMonths($randomMonth)->startOfDay(),
            'updated_at' => $now->copy()->subMonths($randomMonth)->startOfDay(),
        ];
    }
}
