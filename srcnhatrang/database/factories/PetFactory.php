<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PrimaryColor;
use App\Models\Size;
use App\Models\Age;
use App\Models\Breed;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
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
        
        $petNames = [
            'Bông', 'Mít', 'Miu', 'Tôm', 'Cá', 'Bảo', 'Lạc', 'Thỏ', 'Gấu', 'Nana',
            'Bella', 'Charlie', 'Max', 'Lucy', 'Molly', 'Daisy', 'Bailey', 'Buddy', 
            'Rocky', 'Luna', 'Jack', 'Oliver', 'Teddy', 'Simba', 'Leo', 'Loki', 
            'Zoe', 'Lily', 'Coco', 'Chloe', 'Rex', 'Shadow', 'Oscar', 'Milo', 
            'Ruby', 'Sasha', 'Sam', 'Toby', 'Jasper', 'Finn', 'Jake', 'Nala'
        ];
        
        $descriptions = [
            'Rất thân thiện và vui vẻ, luôn sẵn sàng chơi đùa với mọi người.',
            'Thông minh và biết nghe lời, dễ dàng huấn luyện và luôn làm hài lòng chủ nhân.',
            'Thích chơi và rất năng động, luôn tràn đầy năng lượng và vui vẻ.',
            'Rất hiền lành và dễ thương, thích được vuốt ve và ôm ấp.',
            'Thích được vuốt ve và ôm ấp, là một người bạn đồng hành tuyệt vời.',
            'Tính cách độc lập nhưng rất yêu thương, thích tự do khám phá xung quanh.',
            'Rất trung thành và bảo vệ, luôn ở bên cạnh và bảo vệ chủ nhân.',
            'Hiền lành và dễ thương, thích nằm bên cạnh chủ nhân và ngắm nhìn xung quanh.',
            'Rất thông minh và dễ dàng học các trò chơi mới, luôn thích thú với các hoạt động.',
            'Thân thiện và dễ mến, luôn chào đón mọi người bằng cái đuôi quẫy mừng.',
            'Năng động và yêu thích các hoạt động ngoài trời, luôn muốn tham gia vào mọi trò chơi.',
            'Thích yên tĩnh và nghỉ ngơi, là một người bạn đồng hành nhẹ nhàng và ấm áp.',
            'Rất dũng cảm và mạnh mẽ, không sợ hãi trước bất kỳ thử thách nào.',
            'Rất yêu thương và trung thành, luôn theo sát và bảo vệ chủ nhân.',
            'Hiền lành và dễ thương, thích được vuốt ve và chăm sóc.',
            'Thông minh và nhanh nhẹn, dễ dàng học các lệnh và trò chơi mới.',
            'Thân thiện và hòa đồng, dễ dàng kết bạn với các động vật khác.',
            'Rất năng động và vui vẻ, luôn mang lại niềm vui cho mọi người xung quanh.',
            'Yêu thích các hoạt động ngoài trời, luôn tràn đầy năng lượng và vui vẻ.',
            'Hiền lành và dễ mến, là một người bạn đồng hành tuyệt vời.',
            'Rất thông minh và biết lắng nghe, dễ dàng huấn luyện và chăm sóc.',
            'Năng động và yêu đời, luôn mang lại niềm vui và tiếng cười cho mọi người.',
            'Rất thân thiện và dễ gần, luôn muốn được vuốt ve và chăm sóc.',
            'Yêu thích sự yên tĩnh và nghỉ ngơi, là một người bạn đồng hành nhẹ nhàng.',
            'Thông minh và nhanh nhẹn, luôn muốn học hỏi và khám phá.',
            'Thân thiện và hòa đồng, dễ dàng kết bạn với mọi người và các động vật khác.',
            'Năng động và vui vẻ, luôn mang lại niềm vui và tiếng cười cho gia đình.',
            'Rất yêu thương và trung thành, luôn bảo vệ và chăm sóc chủ nhân.',
            'Hiền lành và dễ mến, thích được vuốt ve và chăm sóc.',
            'Thông minh và nhanh nhẹn, dễ dàng học các lệnh và trò chơi mới.',
            'Thân thiện và hòa đồng, dễ dàng kết bạn với các động vật khác.',
            'Rất năng động và vui vẻ, luôn mang lại niềm vui cho mọi người xung quanh.',
            'Yêu thích các hoạt động ngoài trời, luôn tràn đầy năng lượng và vui vẻ.',
            'Hiền lành và dễ mến, là một người bạn đồng hành tuyệt vời.',
            'Rất thông minh và biết lắng nghe, dễ dàng huấn luyện và chăm sóc.',
            'Năng động và yêu đời, luôn mang lại niềm vui và tiếng cười cho mọi người.',
            'Rất thân thiện và dễ gần, luôn muốn được vuốt ve và chăm sóc.',
            'Yêu thích sự yên tĩnh và nghỉ ngơi, là một người bạn đồng hành nhẹ nhàng.',
            'Thông minh và nhanh nhẹn, luôn muốn học hỏi và khám phá.',
            'Thân thiện và hòa đồng, dễ dàng kết bạn với mọi người và các động vật khác.'
        ];
        
        $healthStatuses = ['Khỏe mạnh', 'Bị thương nhẹ', 'Đang hồi phục', 'Cần theo dõi', 'Đang điều trị'];

        return [
            'pet_id' => 'PE' . rand(10000000, 99999999),
            'primary_color_id' => PrimaryColor::inRandomOrder()->first()->primary_color_id,
            'age_id' => Age::inRandomOrder()->first()->age_id,
            'size_id' => Size::inRandomOrder()->first()->size_id,
            'breed_id' => Breed::inRandomOrder()->first()->breed_id,
            'pet_name' => $faker->randomElement($petNames),
            'gender' => $faker->boolean,
            'description' => $faker->randomElement($descriptions),
            'health_status' => $faker->randomElement($healthStatuses),
            'rescued_at' => $faker->dateTimeThisYear($max = 'now'),
        ];
    }
}
