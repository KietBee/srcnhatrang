<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PetAdoption;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetAdoptionRequest>
 */
class PetAdoptionRequestFactory extends Factory
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
        
        // Danh sách lý do nhận nuôi thú cưng
        $reasonsForAdoption = [
            'Muốn có một người bạn đồng hành mới trong cuộc sống hằng ngày, giúp tăng cường sự gắn kết và mang lại niềm vui sau những giờ làm việc căng thẳng.',
            'Yêu thích động vật từ nhỏ và luôn mong muốn có cơ hội chăm sóc, nuôi dưỡng một chú thú cưng để cùng trải qua những khoảnh khắc đáng nhớ.',
            'Gia đình muốn có thêm một thành viên mới để tạo thêm niềm vui và tiếng cười cho cả nhà, đặc biệt là cho các bé nhỏ trong gia đình.',
            'Thú cưng này cần được yêu thương và chăm sóc tận tình sau khi trải qua những hoàn cảnh khó khăn, và tôi sẵn sàng dành thời gian và tâm huyết để giúp đỡ.',
            'Thích có thú cưng để giảm căng thẳng sau giờ làm việc, giúp cải thiện sức khỏe tinh thần và mang lại cảm giác bình yên, thư giãn mỗi ngày.',
            'Trẻ em trong nhà rất yêu thích động vật và luôn mong muốn có một người bạn nhỏ để cùng chơi đùa, học hỏi về tình yêu thương và trách nhiệm.',
            'Muốn có thú cưng để tăng cường vận động và sức khỏe, giúp tạo thói quen đi dạo, chạy bộ và tham gia các hoạt động ngoài trời cùng thú cưng.',
            'Nhận nuôi thú cưng để hỗ trợ tâm lý, giúp giảm bớt căng thẳng, lo âu và cô đơn, đồng thời mang lại niềm vui và cảm giác ấm áp trong cuộc sống.',
            'Muốn có một người bạn trung thành và yêu thương, luôn ở bên cạnh và đồng hành trong mọi khoảnh khắc, chia sẻ niềm vui và nỗi buồn.',
            'Thích có thú cưng để tạo niềm vui trong gia đình, giúp các thành viên gắn kết hơn và cùng nhau chăm sóc, yêu thương một sinh linh nhỏ bé.'
        ];
        
        // Danh sách ghi chú thêm
        $notes = [
            'Đã có kinh nghiệm chăm sóc thú cưng từ trước, hiểu rõ các nhu cầu cơ bản của chúng và luôn sẵn sàng học hỏi thêm để chăm sóc tốt hơn.',
            'Có sân vườn rộng rãi để thú cưng có thể chơi đùa, vận động và tận hưởng không gian thoáng đãng, tự do chạy nhảy và khám phá.',
            'Sẵn sàng chi trả chi phí chăm sóc thú cưng, từ thức ăn, đồ chơi đến các dịch vụ y tế và chăm sóc sức khỏe định kỳ, đảm bảo cho thú cưng có một cuộc sống tốt nhất.',
            'Có kế hoạch đưa thú cưng đi khám sức khỏe định kỳ, tiêm phòng đầy đủ và luôn theo dõi tình trạng sức khỏe của thú cưng để kịp thời xử lý mọi vấn đề.',
            'Thường xuyên ở nhà để chăm sóc thú cưng, đảm bảo thú cưng không cảm thấy cô đơn và luôn được quan tâm, yêu thương và chăm sóc đầy đủ.',
            'Sẽ đảm bảo thú cưng được ăn uống đầy đủ và hợp lý, cung cấp các loại thức ăn dinh dưỡng phù hợp với nhu cầu và sức khỏe của thú cưng.',
            'Sẵn sàng cung cấp môi trường sống an toàn và thoải mái cho thú cưng, từ chỗ ngủ đến không gian sinh hoạt hàng ngày, luôn giữ vệ sinh sạch sẽ.',
            'Đã tìm hiểu kỹ về cách chăm sóc loại thú cưng này, nắm rõ các đặc điểm, thói quen và nhu cầu riêng biệt của chúng để chăm sóc tốt nhất.',
            'Có người thân yêu thích và muốn chăm sóc thú cưng cùng, đảm bảo thú cưng luôn được quan tâm và chăm sóc ngay cả khi bận rộn hoặc vắng nhà.',
            'Cam kết sẽ yêu thương và chăm sóc thú cưng suốt đời, không bỏ rơi hay ngược đãi, luôn coi thú cưng như một thành viên quan trọng trong gia đình.'
        ];

        return [
            'pet_adoption_request_id' => 'PAR' . rand(10000000, 99999999),
            'is_approval' => $faker->boolean(),
            'pet_adoption_id' => PetAdoption::inRandomOrder()->first()->pet_adoption_id,
            'requester_id' => User::inRandomOrder()->first()->id,
            'approver_id' => function (array $attributes) use ($faker) {
                return $attributes['is_approval'] ? User::where('user_type_id', 'ATAD0406')->inRandomOrder()->first()->id : null;
            },
            'reason_for_adoption' => $faker->randomElement($reasonsForAdoption),
            'notes' => $faker->randomElement($notes),
            'approved_at' => function (array $attributes) use ($faker) {
                return $attributes['is_approval'] ? $faker->dateTimeThisYear($max = 'now') : null;
            },
        ];
    }
}
