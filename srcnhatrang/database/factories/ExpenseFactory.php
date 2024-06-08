<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Fund;
use Illuminate\Support\Carbon;

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
        // Set the locale to Vietnamese
        $faker = \Faker\Factory::create('vi_VN');

        $now = Carbon::now();
        $randomMonth = rand(0, $now->month - 1);

        // Lấy ngẫu nhiên một quỹ
        $fund = Fund::inRandomOrder()->first();

        // Nội dung chi tiêu dựa trên nội dung quỹ
        $descriptions = [
            'Quỹ SRC: Quỹ chăm sóc y tế' => [
                'Chi phí kiểm tra sức khỏe định kỳ cho người dân.',
                'Chi phí điều trị bệnh cho những người có hoàn cảnh khó khăn.',
                'Mua thuốc men cho các bệnh nhân nghèo.',
                'Chi phí cho các chương trình kiến thức y tế và tư vấn sức khỏe.',
                'Hỗ trợ tài chính cho các ca phẫu thuật cần thiết.'
            ],
            'Quỹ Cung Cấp Thức Ăn Cho Động Vật' => [
                'Mua thức ăn và nước uống cho động vật trong tình trạng đói khát.',
                'Cung cấp dinh dưỡng cho động vật bị bỏ rơi.',
                'Chi phí vận chuyển thức ăn đến các trại động vật.',
                'Hỗ trợ chi phí chăm sóc và nuôi dưỡng động vật hoang dã.',
                'Chi phí mua thức ăn chất lượng cao cho động vật nuôi.'
            ],
            'Quỹ Hỗ Trợ Phát Triển Giáo Dục Về Y Tế Động Vật' => [
                'Chi phí tổ chức các chương trình giáo dục về y tế động vật.',
                'Mua tài liệu và trang thiết bị phục vụ giảng dạy về y tế động vật.',
                'Chi phí đào tạo và nâng cao kỹ năng cho nhân viên y tế động vật.',
                'Hỗ trợ các dự án nghiên cứu về y tế động vật.',
                'Chi phí cho các hoạt động tư vấn và chăm sóc sức khỏe động vật.'
            ]
        ];

        return [
            'expense_id' => 'EX' . rand(10000000, 99999999),
            'approver_id' => User::where('user_type_id', 'ATAD0406')->inRandomOrder()->first()->id,
            'type' => $faker->boolean(),
            'fund_id' => $fund->fund_id,
            'amount' => $faker->randomFloat(2, 100000, 10000000),
            'description' => $faker->randomElement($descriptions[$fund->title]),
            'created_at' => $now->copy()->subMonths($randomMonth)->startOfDay(),
            'updated_at' => $now->copy()->subMonths($randomMonth)->startOfDay(),
        ];
    }
}
