<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MoneyDonation;
use App\Models\User;
use App\Models\Fund;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Carbon;

class MoneyDonationSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        MoneyDonation::factory()->times(50)->create();

        for ($i = 0; $i < 20; $i++) {
            $randomHour = rand(0, 13);
            $randomMinute = rand(0, 59);
            $randomSecond = rand(0, 59);

            $today = Carbon::now()->startOfDay();

            $randomTime = $today->copy()->addHours($randomHour)->addMinutes($randomMinute)->addSeconds($randomSecond);

            MoneyDonation::create([
                'created_at' => $randomTime,
                'updated_at' => $randomTime,
                'money_donation_id' => 'MD' . rand(10000000, 99999999),
                'donor_id' => User::inRandomOrder()->first()->id,
                'fund_id' => Fund::inRandomOrder()->first()->fund_id,
                'frequency' => $faker->boolean(),
                'status' => $faker->boolean(),
                'amount' => $faker->randomFloat(2, 100000, 10000000),
            ]);
        }
    }
}
