<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pet;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetAdoption>
 */
class PetAdoptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Set the locale to Vietnamese
        $faker = \Faker\Factory::create('vi_VN');
        
        // Danh sách tiêu đề cho bài viết nhận nuôi thú cưng
        $titles = [
            'Nhận nuôi thú cưng đáng yêu',
            'Tìm mái ấm mới cho bé cưng',
            'Cơ hội nhận nuôi chó/mèo thân thiện',
            'Chăm sóc và yêu thương thú cưng mới',
            'Nhận nuôi thú cưng cần sự yêu thương',
            'Cùng tạo nên mái ấm mới cho thú cưng',
            'Cho đi tình yêu, nhận lại niềm vui',
            'Tìm chủ mới cho thú cưng đáng yêu',
            'Chăm sóc thú cưng, hạnh phúc nhân đôi',
            'Nhận nuôi ngay, yêu thương trọn vẹn'
        ];
        
        // Danh sách mô tả cho bài viết nhận nuôi thú cưng
        $descriptions = [
            'Thú cưng của chúng tôi rất thân thiện và dễ thương, cần một mái ấm mới để yêu thương và chăm sóc.',
            'Bé cưng này đã được cứu và cần một gia đình mới để chăm sóc và yêu thương.',
            'Chúng tôi đang tìm kiếm một người chủ mới cho chú chó/mèo này. Rất thân thiện và dễ gần.',
            'Thú cưng này rất thông minh và biết nghe lời, thích hợp với mọi gia đình.',
            'Một bé cưng đầy năng lượng và vui vẻ, sẽ mang lại niềm vui cho bất kỳ gia đình nào.',
            'Thú cưng này rất hiền lành và dễ thương, thích được vuốt ve và ôm ấp.',
            'Bé cưng của chúng tôi đang cần một mái ấm mới để được yêu thương và chăm sóc.',
            'Một chú chó/mèo trung thành và đáng yêu đang chờ đợi một gia đình mới.',
            'Thú cưng này rất năng động và vui vẻ, sẽ là người bạn đồng hành tuyệt vời cho mọi người.',
            'Chúng tôi đang tìm kiếm một người chủ mới có thể chăm sóc và yêu thương thú cưng này.'
        ];
        
        return [
            'pet_adoption_id' => 'PA' . $faker->unique()->numberBetween(10000000, 99999999),
            'image_feature' => 'default.jpg',
            'pet_id' => Pet::inRandomOrder()->first()->pet_id,
            'title' => $faker->randomElement($titles),
            'description' => $faker->randomElement($descriptions),
            'adopted' => $faker->boolean(),
            'created_by' => User::where('user_type_id', 'ATAD0406')->inRandomOrder()->first()->id,
        ];
    }
}
