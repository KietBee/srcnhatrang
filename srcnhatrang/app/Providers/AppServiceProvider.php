<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\UserType;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Fund;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Xác nhận địa chỉ Email')
                ->line('Nhấn vào nút dưới đây để xác nhận địa chỉ email của bạn.')
                ->action('Xác nhận địa chỉ Email', $url);
        });

        View::composer(['page.admin.*', 'index', 'page.app.*', 'livewire.*'], function ($view) {
            $header = [
                'linkPage' => route('home'),
                'logoHeaderLight' => [
                    'url' => asset('storage/images/app/home/header/logo-green.svg'),
                    'alt' => 'Alt text của logo',
                ],
                'logoHeaderDark' => [
                    'url' => asset('storage/images/app/home/header/logo-header.svg'),
                    'alt' => 'Alt text của logo',
                ],
                'menu' => [
                    ['title' => 'Trang chủ', 'url' => route('home')],
                    ['title' => 'Nhận nuôi', 'url' => route('pet-adoptions')],
                    ['title' => 'Đóng góp', 'url' => route('money-donation')],
                    ['title' => 'Báo cáo tài chính', 'url' => route('statistics')],
                    ['title' => 'Tin tức & bài viết', 'url' => route('new-and-post')],
                    ['title' => 'Liên hệ', 'url' => route('feedbacks')],
                ],
            ];

            $homeBanner = [
                'background' => asset('storage/images/app/home/banner/banner.png'),
                'content' => ''
            ];

            $listFund = Fund::All();

            $footer = [
                'linkPage' => '#',
                'logo' => [
                    'url' => asset('storage/images/app/home/header/logo-header.svg'),
                    'alt' => 'Alt text của logo',
                ],
                'aboutUs' => 
                '<p>
                    Trung tâm cứu trợ động vật SRC Nha Trang là một tổ chức phi lợi nhuận được thành lập vào ngày 20/05/2024 có trung tâm đặt tại 02, Nguyễn Đình Chiểu, Vĩnh Thọ, Nha Trang. Trung tâm cứu trợ động vật đầu tiên ở Nha Trang cung cấp thức ăn, nơi trú ẩn và chăm sóc y tế hạng nhất cho động vật vô gia cư.
                </p>',
                'menu' => [
                    ['title' => 'Menu 1', 'url' => '#'],
                    ['title' => 'Menu 2', 'url' => '#'],
                    ['title' => 'Menu 3', 'url' => '#'],
                ],
            ];

            $view->with([
                'header' => $header,
                'homeBanner' => $homeBanner,
                'listFund' => $listFund,
                'footer' => $footer,
            ]);
        });

        View::composer(['page.admin.*'], function ($view) {
            $header = [
                'logoHeader' => [
                    'url' => asset('images/logo-header.svg'),
                    'alt' => 'Alt text của logo',
                ],
                'menu' => [
                    ['title' => 'Menu 1', 'url' => '#'],
                    ['title' => 'Menu 2', 'url' => '#'],
                    ['title' => 'Menu 3', 'url' => '#'],
                ],
            ];

            $sideBar = [
                [
                    'title' => 'Trang chủ',
                    'url' => route('home'),
                    'icon' => '<svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                </svg>',
                ],
                [
                    'title' => 'Quyên góp bằng tiền',
                    'url' => route('home'),
                    'icon' => '',
                    'has_sub' => [
                        [
                            'title' => 'Danh sách quyên góp',
                            'url' => '#',
                            'icon' => '',
                        ],
                        [
                            'title' => 'Tiền mặc định quyên góp một lần',
                            'url' => '#',
                            'icon' => '',
                        ],
                        [
                            'title' => 'Tiền mặc định quyên góp theo tháng',
                            'url' => '#',
                            'icon' => '',
                        ],
                    ]
                ],
                [
                    'title' => 'Quản lý người dùng',
                    'url' => '#',
                    'icon' => '
                    <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                    </svg>
                    ',
                    'has_sub' => [
                        [
                            'title' => 'Danh sách người dùng',
                            'url' => route('admin.user'),
                            'icon' => '
                            <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                            </svg>
                            ',
                        ],
                        [
                            'title' => 'Loại người dùng',
                            'url' => route('admin.pet-adoption'),
                            'icon' => '
                            <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4"/>
                            </svg>
                            ',
                        ]
                    ]
                ],
                [
                    'title' => 'Quản lý chi tiêu',
                    'url' => route('home'),
                    'icon' => '',
                ],
                [
                    'title' => 'Quản lý quỹ',
                    'url' => route('home'),
                    'icon' => '',
                ],
                [
                    'title' => 'Quản lý thú cưng',
                    'url' => '#',
                    'icon' => '',
                    'has_sub' => [
                        [
                            'title' => 'Danh sách Thú cưng',
                            'url' => route('admin.pet'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Thú cưng nhận nuôi',
                            'url' => route('admin.pet-adoption'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Yêu cầu nhận nuôi',
                            'url' => route('admin.pet-adoption-request'),
                            'icon' => '',
                        ],
                    ]
                ],
                [
                    'title' => 'Danh mục thú cưng',
                    'url' => '#',
                    'icon' => '',
                    'has_sub' => [
                        [
                            'title' => 'Loại',
                            'url' => route('admin.pet'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Giống',
                            'url' => route('admin.pet-adoption'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Màu sắc',
                            'url' => route('admin.pet-adoption-request'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Tuổi',
                            'url' => route('admin.pet-adoption-request'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Kích thước',
                            'url' => route('admin.pet-adoption-request'),
                            'icon' => '',
                        ]
                    ]
                ],
                [
                    'title' => 'Quản lý bài viết',
                    'url' => '#',
                    'icon' => '',
                    'has_sub' => [
                        [
                            'title' => 'Danh sách bài viết',
                            'url' => route('admin.pet'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Loại bài viết',
                            'url' => route('admin.pet-adoption'),
                            'icon' => '',
                        ],
                    ]
                ],
                [
                    'title' => 'Phản hồi người dùng',
                    'url' => route('admin.feedback'),
                    'icon' => '
                    <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.502 7.046h-2.5v-.928a2.122 2.122 0 0 0-1.199-1.954 1.827 1.827 0 0 0-1.984.311L3.71 8.965a2.2 2.2 0 0 0 0 3.24L8.82 16.7a1.829 1.829 0 0 0 1.985.31 2.121 2.121 0 0 0 1.199-1.959v-.928h1a2.025 2.025 0 0 1 1.999 2.047V19a1 1 0 0 0 1.275.961 6.59 6.59 0 0 0 4.662-7.22 6.593 6.593 0 0 0-6.437-5.695Z"/>
                    </svg>
                    ',
                ],
                [
                    'title' => 'Thống kê',
                    'url' => '#',
                    'icon' => '',
                ],
                [
                    'title' => 'Danh sách Q & A',
                    'url' => route('admin.QA'),
                    'icon' => '
                    <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z" clip-rule="evenodd"/>
                            </svg>

                    ',
                ]
            ];

            $view->with([
                'header' => $header,
                'sideBar' => $sideBar,
            ]);
        });

        View::composer(['page.admin.user', 'page.admin.user-detail'], function ($view) {
            $provinces = Province::all();
            $districts = District::all();
            $wards = Ward::all();
            $listType = UserType::all();
            $view->with([
                'listType' => $listType,
                'provinces' => $provinces,
                'districts' => $districts,
                'wards' => $wards
            ]);
        });

        View::composer(['page.admin.pet', 'page.admin.pet-adoption'], function ($view) {
            $listBreeds = Breed::all();
            $view->with([
                'listBreeds' => $listBreeds
            ]);
        });

        View::composer(['components.app.*'], function ($view) {
            $allCategories = Category::all();
            $view->with([
                'allCategories' => $allCategories
            ]);
        });
    }
}
