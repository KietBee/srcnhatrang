<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Story;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoryCategory>
 */
class StoryCategoryFactory extends Factory
{
    protected $usedCombinations = [];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $storyid = Story::pluck('story_id')->toArray();
        $categoryid = Category::pluck('category_id')->toArray();

        $combination = null;
        do {
            $story = $this->faker->randomElement($storyid);
            $category = $this->faker->randomElement($categoryid);
            $combination = $story . '-' . $category;
        } while (in_array($combination, $this->usedCombinations));

        $this->usedCombinations[] = $combination;

        return [
            'story_id' => $story,
            'category_id' => $category,
        ];
    }
}
