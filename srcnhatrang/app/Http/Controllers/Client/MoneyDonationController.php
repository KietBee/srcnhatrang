<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\MoneyDonation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;

class MoneyDonationController extends Controller
{
    public function index()
    {
        return view('page.app.money-donation.money-donation');
    }

    public function thanks() {
        if (!session()->has('aboutUs') || empty(session('aboutUs'))) {
            return redirect()->route('money-donation');
        } else {
            return view('page.app.money-donation.thanks')->with('aboutUs', session('aboutUs'));
        }
    }
    
    public function handlePayment(Request $request)
    {
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $inputData = $request->only(array_filter(array_keys($request->all()), function ($key) {
            return substr($key, 0, 4) == "vnp_";
        }));

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);

        $hashData = urldecode(http_build_query($inputData));

        $vnp_HashSecret = "6BATOYHYGZJUGR7LYUX6ZIEZTXULN6S3";

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {

            if ($request->get('vnp_ResponseCode') === '00') {
                if (Auth::check()) {
                    $donorId = Auth::user()->id;
                } else {
                    $firstUser = User::first();
                    if ($firstUser) {
                        $donorId = $firstUser->id;
                    }
                }
                $moneyDonation = MoneyDonation::create([
                    'money_donation_id' => $request->get('IDTxnRef'),
                    'donor_id' => $donorId,
                    'fund_id' => $request->get('fund'),
                    'frequency' => $request->get('OrderType') == 'monthly' ? true : false,
                    'status' => true,
                    'amount' => $request->get('Amount'),
                ]);

                if ($moneyDonation->wasRecentlyCreated) {
                    $fund = Fund::findOrFail($request->get('fund'));
                    $fund->current_balance += $request->get('Amount');
                    $fund->save();

                    $title = 'SRC Nha Trang - Cảm ơn vì món quà';
                    $content = 'Cảm ơn vì món quà của bạn!';
                    $view = 'email.feedback';

                    Mail::to($moneyDonation->donor->email)->send(new NotifyMail($title, $content, $view));
                    $aboutUs = [
                        'content' => '
                        <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                            Cảm ơn bạn vì món quà!
                        </h2>
                        <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
                        <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
                        <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
                        <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
                        <a href="' . route('home') . '" class="inline-block bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Quay về trang chủ</a>
                        ',
                        'image' => [
                            'url' => asset('storage/images/app/home/tram-cuu-ho-dong-vat-1.jpg'),
                            'alt' => 'trung tâm cứu hộ động vật SRC Nha Trang',
                        ],
                    ];
                    return redirect()->route('thanks')->with('aboutUs', $aboutUs);
                } else {
                    $aboutUs = [
                        'content' => '
                        <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                            Tặng quà không thành công!
                        </h2>
                        <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
                        <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
                        <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
                        <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
                        <a href="' . route('home') . '" class="inline-block bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Quay về trang chủ</a>
                        ',
                        'image' => [
                            'url' => asset('storage/images/app/home/tram-cuu-ho-dong-vat-1.jpg'),
                            'alt' => 'trung tâm cứu hộ động vật SRC Nha Trang',
                        ],
                    ];
                    return redirect()->route('thanks')->with('aboutUs', $aboutUs);
                }
            } else {
                $aboutUs = [
                    'content' => '
                    <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                        Tặng quà không thành công!
                    </h2>
                    <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
                    <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
                    <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
                    <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
                    <a href="' . route('home') . '" class="inline-block bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Quay về trang chủ</a>
                    ',
                    'image' => [
                        'url' => asset('storage/images/app/home/tram-cuu-ho-dong-vat-1.jpg'),
                        'alt' => 'trung tâm cứu hộ động vật SRC Nha Trang',
                    ],
                ];
                return redirect()->route('thanks')->with('aboutUs', $aboutUs);
            }
        } else {
            $aboutUs = [
                'content' => '
                <h2 class="my-6 text-2xl tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl">
                    Mã thanh toán không hợp lệ!
                </h2>
                <p>Chúng tôi là một tổ chức phi lợi nhuận tận tâm và nhiệt huyết, cam kết đem lại sự chăm sóc và yêu thương cho các bé thú cưng bị bỏ rơi, bị bỏ bê, hoặc cần được cứu trợ. Tại Trung Tâm, chúng tôi không chỉ cung cấp một môi trường an toàn và ấm áp cho các bé thú cưng mà còn tạo điều kiện cho họ tìm được một ngôi nhà mới, nơi họ có thể được yêu thương và chăm sóc một cách tốt nhất.</p>
                <p>Chúng tôi hoạt động dựa trên nguyên tắc tôn trọng và yêu quý mọi loài vật. Chúng tôi không chỉ giúp đỡ các bé thú cưng mà còn tạo ra những chương trình giáo dục và tư vấn để tăng cường nhận thức về quyền lợi và trách nhiệm của con người đối với thú cưng.</p>
                <p>Nếu bạn là một người yêu thú cưng và muốn chung tay cùng chúng tôi giúp đỡ những bé thú cưng gặp khó khăn, hãy cùng tham gia vào các hoạt động quyên góp và nhận nuôi tại Trung Tâm Cứu Trợ Động Vật Nha Trang. Mỗi đóng góp của bạn đều là một sự giúp đỡ lớn lao cho các bé thú cưng và là sự ủng hộ không ngừng nghỉ cho công việc của chúng tôi.</p>
                <p>Hãy cùng nhau tạo nên một cộng đồng yêu thương và chăm sóc cho các bé thú cưng. Hãy chung tay với chúng tôi để mỗi bé thú cưng đều có được một cuộc sống hạnh phúc và an lành. Xin cảm ơn sự quan tâm và ủng hộ từ tất cả mọi người!</p>
                <a href="' . route('home') . '" class="inline-block bg-gradient-to-r mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Quay về trang chủ</a>
                ',
                'image' => [
                    'url' => asset('storage/images/app/home/tram-cuu-ho-dong-vat-1.jpg'),
                    'alt' => 'trung tâm cứu hộ động vật SRC Nha Trang',
                ],
            ];
            return redirect()->route('thanks')->with('aboutUs', $aboutUs);
        }
    }
}
