<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Set locale to Vietnamese
        $faker = \Faker\Factory::create('vi_VN');

        $contentOptions = [
            'Tôi muốn quyên góp cho quỹ cứu trợ động vật. Làm thế nào để tôi có thể đóng góp?',
            'Xin vui lòng cung cấp thông tin về các chương trình cứu trợ động vật mà tôi có thể tham gia.',
            'Tôi rất quan tâm đến việc cứu trợ động vật bị bỏ rơi và muốn biết cách thức quyên góp.',
            'Làm thế nào để tôi có thể đóng góp cho tổ chức của bạn để giúp động vật bị thương?',
            'Tôi muốn hỗ trợ tài chính cho việc cứu trợ động vật. Xin vui lòng cho tôi biết các bước thực hiện.',
            'Quỹ cứu trợ động vật của bạn có nhận quyên góp hàng tháng không? Làm thế nào để tôi đăng ký?',
            'Tôi đã quyên góp nhưng chưa nhận được xác nhận. Xin vui lòng kiểm tra giúp tôi.',
            'Tôi muốn biết thêm về các hoạt động cứu trợ động vật của tổ chức. Làm thế nào để tôi có thể tham gia?'
        ];

        $responseOptions = [
            'Cảm ơn bạn đã quan tâm và muốn đóng góp. Để tham gia, bạn có thể truy cập trang web của chúng tôi và tìm hiểu về các chương trình cứu trợ động vật.',
            'Chúng tôi rất biết ơn sự quan tâm của bạn. Xin vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại được cung cấp trên trang web để biết thêm chi tiết về cách thức quyên góp.',
            'Cảm ơn bạn đã liên hệ. Chúng tôi đã ghi nhận thông tin của bạn và sẽ cố gắng trả lời trong thời gian sớm nhất.',
            'Chúng tôi hoan nghênh mọi sự đóng góp của bạn. Vui lòng theo dõi email để nhận được thông tin cụ thể về cách thức quyên góp và các dự án cứu trợ động vật của chúng tôi.',
            'Cảm ơn bạn đã hỏi về cách thức quyên góp. Bạn có thể truy cập trang web của chúng tôi để biết thêm thông tin hoặc liên hệ trực tiếp với chúng tôi để được hỗ trợ.',
            'Chúng tôi rất biết ơn sự ủng hộ của bạn. Hãy đảm bảo kiểm tra email của mình để nhận thông tin cập nhật về các hoạt động quyên góp và cứu trợ động vật của tổ chức chúng tôi.',
            'Chúng tôi đã nhận được thông tin của bạn và sẽ liên hệ lại trong thời gian sớm nhất để cung cấp thông tin chi tiết về cách thức quyên góp và các dự án cứu trợ động vật.',
            'Xin lỗi bạn gặp sự cố này. Chúng tôi sẽ kiểm tra và trả lời lại bạn trong thời gian sớm nhất.'
        ];

        return [
            'feedback_id' => 'FB'.rand(10000000, 99999999),
            'sender' => User::inRandomOrder()->first()->id,
            'content' => $faker->randomElement($contentOptions),
            'is_responded' => $faker->boolean(),
            'responder' => function (array $attributes) use ($faker) {
                return $attributes['is_responded'] ? User::inRandomOrder()->first()->id : null;
            },
            'response' => function (array $attributes) use ($faker, $responseOptions) {
                return $attributes['is_responded'] ? $faker->randomElement($responseOptions) : null;
            },
            'responded_at' => function (array $attributes) use ($faker) {
                return $attributes['is_responded'] ? $faker->dateTimeThisYear($max = 'now') : null;
            },
        ];
    }
}
