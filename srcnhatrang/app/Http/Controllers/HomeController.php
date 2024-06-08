<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PetAdoption;
use App\Models\Story;

class HomeController extends Controller
{
    public function index()
    {
        $bannerSlide = [
            [
                'content' => '
                    <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                        Giới thiệu về chúng tôi
                    </h2>
                    <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
                    <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
                    <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
                    <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
                    <button class="bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Tìm hiểu thêm về chúng tôi</button>
                ',
                'url' => 'https://cdn.shopify.com/s/files/1/0624/1746/9697/files/mai-am-gia-dinh-cua-nhung-thu-cung-bi-bo-roi-tai-ha-noidocx-1635643512893_600x600.webp?v=1673490356',
                'alt' => 'image slide'
            ],
            [
                'content' => '
                    <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                        Giới thiệu về chúng tôi
                    </h2>
                    <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
                    <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
                    <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
                    <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
                    <button class="bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Tìm hiểu thêm về chúng tôi</button>
                ',
                'url' => 'https://cdn.shopify.com/s/files/1/0624/1746/9697/files/nhung-nguoi-tre-cuu-hang-ngan-cho-meo-bi-vut-bo-1_600x600.jpg?v=1673490481',
                'alt' => 'image slide'
            ],
            [
                'content' => '
                    <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                        Giới thiệu về chúng tôi
                    </h2>
                    <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
                    <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
                    <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
                    <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
                    <button class="bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Tìm hiểu thêm về chúng tôi</button>
                ',
                'url' => 'https://media.urbanistnetwork.com/urbanistvietnam/articleimages/2021/08/31/animal-shelter/10h.webp',
                'alt' => 'image slide'
            ],
        ];

        $aboutUs = [
            'content' => '
            <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                Giới thiệu về chúng tôi
            </h2>
            <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
            <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
            <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
            <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
            <button class="bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Tìm hiểu thêm về chúng tôi</button>
            ',
            'image' => [
                'url' => asset('storage/images/app/home/tram-cuu-ho-dong-vat-1.jpg'),
                'alt' => 'trung tâm cứu hộ động vật SRC Nha Trang',
            ],
        ];

        $petAdoption = PetAdoption::where('adopted', false)
            ->orderBy('updated_at', 'asc')
            ->first();
        $postPetAdoption = [
            'title' => 'Xin chào! Con tên là ' . $petAdoption->pet['pet_name'],
            'description' => $petAdoption['description'],
            'image' => [
                'url' => $petAdoption['image_feature']?asset('storage/images/'.$petAdoption['image_feature']):asset('storage/images/default.jpg'),
                'alt' => 'hình thú cưng',
            ],
            'link' => [
                'url' => route('pet-adoptions.details', ['id' => $petAdoption->pet_adoption_id]),
                'title' => 'Nhận nuôi thú cưng',
            ],
            'linkAll' => [
                'url' => route('pet-adoptions'),
                'title' => 'Xem tất cả thú cưng',
            ],
        ];

        $stories = Story::orderBy('approved_at', 'desc')->take(3)->get();

        $listStories = [];
        $postStories = [];

        foreach ($stories as $story) {
            $postStories[] = [
                'title' => $story->title,
                'description' => $story->content,
                'date' => $story->approved_at,
                'category' => $story->category,
                'image' => [
                    'url' => $story->feature_image_url?asset('storage/images/'.$story->feature_image_url):asset('storage/images/default.jpg'),
                    'alt' => $story->title,
                ],
                'link' => [
                    'url' => route('new-and-post.details', ['id' => $story->story_id]),
                    'title' => 'Đọc thêm',
                ],
            ];
        }
        $listStories['postStories'] = $postStories;
        $listStories['headline'] = 'Tin tức và bài viết mới nhất';
        $listStories['linkAll'] = [
            'url' => route('new-and-post'),
            'title' => 'Xem tất cả tin tức và bài viết',
        ];

        if (Auth::id()) {
            $userType = Auth()->user()->userType->user_type_name;

            if ($userType == 'user') {
                return view('index', compact('bannerSlide', 'aboutUs', 'postPetAdoption', 'listStories'));
            } elseif ($userType == 'admin') {
                return view('page.admin.dashboard');
            } else {
                return redirect()->back();
            }
        } else {
            return view('index', compact('bannerSlide', 'aboutUs', 'postPetAdoption', 'listStories'));
        }
    }
}
