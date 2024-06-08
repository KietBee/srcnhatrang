<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FundSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('funds')->insert([
            [
                'fund_id' => 'FB'.rand(10000000, 99999999),
                'created_by' => User::where('user_type_id', 'ATAD0406')->inRandomOrder()->first()->id,
                'title' => 'Quỹ SRC: Quỹ chăm sóc y tế',
                'description' => 'Quỹ SRC: Quỹ chăm sóc y tế nhằm mục đích hỗ trợ chi phí chăm sóc y tế cho những người có hoàn cảnh khó khăn hoặc không có điều kiện điều trị y tế đúng cách. Quỹ sẽ được sử dụng để chi trả cho các dịch vụ y tế cần thiết như kiểm tra sức khỏe, điều trị bệnh, thuốc men, và các chi phí y tế khác. Mục tiêu của quỹ là cung cấp một phần hỗ trợ tài chính đối với những người cần thiết, giúp họ có thể tiếp cận các dịch vụ y tế cần thiết để duy trì sức khỏe và sự phát triển. Quỹ cũng có thể hỗ trợ các hoạt động như chương trình kiến thức y tế, tư vấn sức khỏe, và các dự án cộng đồng khác liên quan đến y tế.',
                'feature_image' => 'default.jpg',
                'current_balance' => 60000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fund_id' => 'FB'.rand(10000000, 99999999),
                'created_by' => User::where('user_type_id', 'ATAD0406')->inRandomOrder()->first()->id,
                'title' => 'Quỹ Cung Cấp Thức Ăn Cho Động Vật',
                'description' => 'Quỹ cung cấp thức ăn, nước uống và dinh dưỡng cho các động vật trong tình trạng đói khát hoặc không đủ thức ăn.',
                'feature_image' => 'default.jpg',
                'current_balance' => 50000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fund_id' => 'FB'.rand(10000000, 99999999),
                'created_by' => User::where('user_type_id', 'ATAD0406')->inRandomOrder()->first()->id,
                'title' => 'Quỹ Hỗ Trợ Phát Triển Giáo Dục Về Y Tế Động Vật',
                'description' => 'Quỹ hỗ trợ các chương trình giáo dục và tư vấn về y tế động vật, nhằm nâng cao nhận thức và kiến thức của cộng đồng về cách chăm sóc và bảo vệ sức khỏe của động vật.',
                'feature_image' => 'default.jpg',
                'current_balance' => 40000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
