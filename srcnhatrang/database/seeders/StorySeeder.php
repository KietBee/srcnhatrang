<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Category;
use App\Models\User;
use App\Models\StoryCategory;
class StorySeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        $sampleData = [
            'Tin tức' => [
                'titles' => [
                    'Những sự kiện mới nhất về thế giới động vật',
                    'Thông báo quan trọng về bảo vệ động vật hoang dã',
                    'Câu chuyện kỳ diệu về việc cứu hộ động vật',
                ],
                'contents' => [
                    'Cập nhật tin tức mới nhất về thế giới động vật và các sự kiện đáng chú ý.',
                    'Thông tin về những chiến dịch bảo vệ động vật hoang dã và những thách thức mà chúng đang đối mặt.',
                    'Những câu chuyện cảm động về những cuộc cứu hộ động vật và những nỗ lực cứu giúp của con người.',
                ],
            ],
            'Câu chuyện nhỏ' => [
                'titles' => [
                    'Khoảnh khắc đáng yêu của thú cưng trong cuộc sống hàng ngày',
                    'Những câu chuyện nhỏ về tình bạn động vật',
                    'Câu chuyện về sự thông minh và sự đáng yêu của thú cưng',
                ],
                'contents' => [
                    'Chia sẻ những khoảnh khắc đáng yêu và hạnh phúc trong cuộc sống hàng ngày của thú cưng.',
                    'Những câu chuyện ấm áp về tình bạn động vật và những kỷ niệm đáng nhớ.',
                    'Kể về sự thông minh, sự trung thành và sự đáng yêu của thú cưng trong những tình huống khác nhau.',
                ],
            ],
            'Mẹo chăm thú cưng' => [
                'titles' => [
                    '10 mẹo chăm sóc thú cưng mùa hè',
                    'Bí quyết giữ cho thú cưng luôn khỏe mạnh',
                    'Những lời khuyên hữu ích trong việc nuôi dưỡng thú cưng',
                ],
                'contents' => [
                    '10 mẹo giúp bạn chăm sóc thú cưng một cách hiệu quả và an toàn trong mùa hè nắng nóng.',
                    'Bí quyết để thú cưng của bạn luôn khỏe mạnh và hạnh phúc trong mọi hoàn cảnh.',
                    'Những lời khuyên và kinh nghiệm từ chuyên gia trong việc nuôi dưỡng và chăm sóc thú cưng của bạn.',
                ],
            ],
        ];

        foreach ($categories as $category) {
            $categorySampleData = $sampleData[$category->category_name];

            for ($i = 0; $i < 3; $i++) {
                $story = Story::create([
                    'story_ID' => 'ST' . rand(10000000, 99999999),
                    'title' => $categorySampleData['titles'][array_rand($categorySampleData['titles'])],
                    'content' => $categorySampleData['contents'][array_rand($categorySampleData['contents'])],
                    'feature_image_url' => 'default.jpg',
                    'author_ID' => User::inRandomOrder()->first()->id,
                    'is_approved' => true,
                    'approver_Id' => User::where('user_type_id', 'ATAD0406')->inRandomOrder()->first()->id,
                    'approved_at' => now(),
                    'is_edited' => false,
                    'edited_at' => null,
                ]);

                StoryCategory::create([
                    'story_id' => $story->story_ID,
                    'category_id' => $category->category_id,
                ]);
            }
        }
    }
}
