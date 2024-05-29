<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Fund;
use App\Models\Item;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expense_id' => $this->faker->unique()->uuid,
            'approver_id' => User::factory()->create()->id,
            'type' => $this->faker->boolean(),
            'fund_id' => Fund::factory()->create()->fund_id,
            'item_id' => Item::factory()->create()->item_id,
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'description' => $this->faker->paragraph,
        ];
    }
}
