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
use App\Models\PetAdoption;
use App\Models\PetAdoptionRequest;
use App\Models\Story;
use App\Models\Feedback;
use App\Models\User;
use App\Models\MoneyDonation;
use App\Models\Statistic;
use App\Models\PrimaryColor;
use App\Models\Age;
use App\Models\Size;
use App\Models\Specie;
use Illuminate\Support\Carbon;

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

        View::composer(['page.admin.dashboard'], function ($view) {
            $hour = Carbon::now()->format('H');

            if ($hour >= 5 && $hour < 11) {
                $title = "Xin chào buổi sáng";
            } elseif ($hour >= 11 && $hour < 14) {
                $title = "Xin chào buổi trưa";
            } elseif ($hour >= 14 && $hour < 18) {
                $title = "Xin chào buổi chiều";
            } else {
                $title = "Xin chào buổi tối";
            }

            $totalPets = Pet::count();
            $adoptedPets = PetAdoption::where('adopted', true)->count();
            $petNumber = $totalPets - $adoptedPets;

            $petAdoptionRequestNumber = PetAdoptionRequest::where('is_approval', false)->count();

            $storyNumber = Story::where('is_approved', false)->count();

            $feedBackNumber = Feedback::where('is_responded', false)->count();

            $userNumber = User::count();

            $startOfDay = Carbon::now()->startOfDay();
            $endOfDay = Carbon::now()->endOfDay();
            $newUserNumber = User::whereBetween('created_at', [$startOfDay, $endOfDay])->count();

            $donationData = MoneyDonation::where('created_at', '>=', $startOfDay)
                ->orderBy('created_at')
                ->get()
                ->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('H');
                })
                ->map(function ($item) {
                    return $item->count();
                })
                ->toArray();

            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $monthlyTotals = [];
            for ($month = 1; $month <= $currentMonth; $month++) {
                $totals = Statistic::where('year', $currentYear)
                    ->where('month', $month)
                    ->selectRaw('SUM(total_money_expenses) as total_expenses, SUM(total_amount_donation) as total_donations')
                    ->first();
                $monthlyTotals[$month] = [
                    'total_money_expenses' => $totals->total_expenses ?? 0,
                    'total_amount_donation' => $totals->total_donations ?? 0,
                ];
            }

            $view->with([
                'title' => $title,
                'petNumber' => $petNumber,
                'petAdoptionRequestNumber' => $petAdoptionRequestNumber,
                'storyNumber' => $storyNumber,
                'feedBackNumber' => $feedBackNumber,
                'userNumber' => $userNumber,
                'newUserNumber' => $newUserNumber,
                'donationData' => $donationData,
                'monthlyTotals' => $monthlyTotals,
            ]);
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
                    'title' => 'Quyên góp',
                    'url' => '',
                    'icon' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 7h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C10.4 2.842 8.949 2 7.5 2A3.5 3.5 0 0 0 4 5.5c.003.52.123 1.033.351 1.5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2Zm-9.942 0H7.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z"/>
                  </svg>
                  
                  ',
                    'has_sub' => [
                        [
                            'title' => 'Danh sách quyên góp',
                            'url' => route('admin.money-donation'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Tiền mặc định quyên góp một lần',
                            'url' => route('admin.predefined-only-amount'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Tiền mặc định quyên góp theo tháng',
                            'url' => route('admin.predefined-monthly-amount'),
                            'icon' => '',
                        ],
                    ]
                ],
                [
                    'title' => 'Người dùng',
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
                            'icon' => '',
                        ],
                        [
                            'title' => 'Loại người dùng',
                            'url' => route('admin.user-type'),
                            'icon' => '',
                        ]
                    ]
                ],
                [
                    'title' => 'Quản lý chi tiêu',
                    'url' => route('admin.expense'),
                    'icon' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 10h9.231M6 14h9.231M18 5.086A5.95 5.95 0 0 0 14.615 4c-3.738 0-6.769 3.582-6.769 8s3.031 8 6.769 8A5.94 5.94 0 0 0 18 18.916"/>
                  </svg>',
                ],
                [
                    'title' => 'Quản lý quỹ',
                    'url' => route('admin.fund'),
                    'icon' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M10.915 2.345a2 2 0 0 1 2.17 0l7 4.52A2 2 0 0 1 21 8.544V9.5a1.5 1.5 0 0 1-1.5 1.5H19v6h1a1 1 0 1 1 0 2H4a1 1 0 1 1 0-2h1v-6h-.5A1.5 1.5 0 0 1 3 9.5v-.955a2 2 0 0 1 .915-1.68l7-4.52ZM17 17v-6h-2v6h2Zm-6-6h2v6h-2v-6Zm-2 6v-6H7v6h2Z" clip-rule="evenodd"/>
                    <path d="M2 21a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Z"/>
                  </svg>
                  ',
                ],
                [
                    'title' => 'Quản lý thú cưng',
                    'url' => '#',
                    'icon' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M22 5.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.343 8.343 0 0 1-2.605.981A4.13 4.13 0 0 0 15.85 4a4.068 4.068 0 0 0-4.1 4.038c0 .31.035.618.105.919A11.705 11.705 0 0 1 3.4 4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 6.1 13.635a4.192 4.192 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 2 18.184 11.732 11.732 0 0 0 8.291 20 11.502 11.502 0 0 0 19.964 8.5c0-.177 0-.349-.012-.523A8.143 8.143 0 0 0 22 5.892Z" clip-rule="evenodd"/>
                  </svg>
                  ',
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
                    'icon' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z" clip-rule="evenodd"/>
                  </svg>
                  ',
                    'has_sub' => [
                        [
                            'title' => 'Hình ảnh',
                            'url' => route('admin.pet-image'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Loại',
                            'url' => route('admin.species'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Giống',
                            'url' => route('admin.breed'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Màu sắc',
                            'url' => route('admin.primary-color'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Tuổi',
                            'url' => route('admin.age'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Kích thước',
                            'url' => route('admin.size'),
                            'icon' => '',
                        ]
                    ]
                ],
                [
                    'title' => 'Tin tức & Bài viết',
                    'url' => '#',
                    'icon' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd"/>
                  </svg>
                  ',
                    'has_sub' => [
                        [
                            'title' => 'Danh sách',
                            'url' => route('admin.story'),
                            'icon' => '',
                        ],
                        [
                            'title' => 'Danh mục',
                            'url' => route('admin.category'),
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
                    'url' => route('admin.statistic'),
                    'icon' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667"/>
                  </svg>
                  ',
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

        View::composer(['page.admin.expense.index', 'page.admin.expense.edit'], function ($view) {
            $listFunds = Fund::all();
            $view->with([
                'listFunds' => $listFunds,
            ]);
        });

        View::composer(['page.admin.user.*',], function ($view) {
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

        View::composer(['page.admin.pet.*', 'page.admin.pet-adoption.*', 'page.admin.breed.*', 'page.admin.pet-image.*'], function ($view) {
            $listPets = Pet::all();
            $listSpecies = Specie::all();
            $listBreeds = Breed::all();
            $listColors = PrimaryColor::all();
            $listAges = Age::all();
            $listSizes = Size::all();
            $view->with([
                'listPets' => $listPets,
                'listSpecies' => $listSpecies,
                'listBreeds' => $listBreeds,
                'listColors' => $listColors,
                'listAges' => $listAges,
                'listSizes' => $listSizes,
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
