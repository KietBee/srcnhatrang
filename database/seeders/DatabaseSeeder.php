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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
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
            StoryCategorySeeder::class,
            FundSeeder::class,
            MoneyDonationSeeder::class,
            ItemTypeSeeder::class,
            ItemSeeder::class,
            DeliveryMethodSeeder::class,
            // ItemDonationSeeder::class,
            // DetailItemDonationSeeder::class,
        ]);
    }
}
