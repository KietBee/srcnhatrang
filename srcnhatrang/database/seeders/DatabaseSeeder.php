<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddressSeeder::class,
            UserTypeSeeder::class,
            UserSeeder::class,
            PrimaryColorSeeder::class,
            SizeSeeder::class,
            AgeSeeder::class,
            SpecieSeeder::class,
            BreedSeeder::class,
            PetSeeder::class,
            PetImageSeeder::class,
            PetAdoptionSeeder::class,
            PetAdoptionRequestSeeder::class,
            FeedbackSeeder::class,
            CategorySeeder::class,
            StorySeeder::class,
            FundSeeder::class,
            MoneyDonationSeeder::class,
            QASeeder::class,
            PredefinedMonthlyAmountSeeder::class,
            PredefinedOnlyAmountSeeder::class,
            ExpenseSeeder::class,
        ]);
    }
}
