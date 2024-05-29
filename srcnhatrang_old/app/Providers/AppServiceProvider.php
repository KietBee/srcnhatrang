<?php

// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

// class AppServiceProvider extends ServiceProvider
// {
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap any application services.
//      */
//     public function boot(): void
//     {
//         //
//     }
// }

namespace App\Providers;

use App\Models\District;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\UserType;
use App\Models\Province;
use App\Models\Ward;

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
        View::composer('*', function($view) {
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
                    'url' => route('home'),
                    'icon' => '',
                    'has_sub' => [
                        [
                            'title' => 'Quyên góp bằng tiền', 
                            'url' => '#',
                            'icon' => '',
                        ],
                        [
                            'title' => 'Quyên góp vật phẩm', 
                            'url' => '#',
                            'icon' => '',
                        ],
                    ]
                ],
                [
                    'title' => 'Quản lý người dùng',
                    'url' => route('admin.user'),
                    'icon' => '<svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                  </svg>
                  ',
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
                    'title' => 'Quản lý vật phẩm',
                    'url' => route('home'),
                    'icon' => '',
                ],
                [
                    'title' => 'Quản lý danh mục',
                    'url' => '#',
                    'icon' => '',
                    'has_sub' => [
                        [
                            'title' => 'Loại người dùng', 
                            'url' => '#',
                            'icon' => '',
                        ],
                        [
                            'title' => 'Phương thức giao hàng', 
                            'url' => '#',
                            'icon' => '',
                        ],
                        [
                            'title' => 'Địa chỉ', 
                            'url' => '#',
                            'icon' => '',
                        ],
                        [
                            'title' => 'Thú cưng', 
                            'url' => '#',
                            'icon' => '',
                        ],
                        [
                            'title' => 'Loại vật phẩm', 
                            'url' => '#',
                            'icon' => '',
                        ]
                    ]
                ],
                [
                    'title' => 'Quản lý bài viết',
                    'url' => '#',
                    'icon' => ''
                ],
                [
                    'title' => 'Tiện ích mở rộng',
                    'url' => '#',
                    'icon' => ''
                ],
            ];            
        
            $view->with([
                'header' => $header,
                'sideBar' => $sideBar,
            ]);
        });
        

        View::composer(['admin.page.user', 'userType', 'admin.page.user-detail'], function ($view) {
            $provinces = Province::all();
            $districts = District::all();
            $wards = Ward::all();
            $listType = UserType::getAllUserTypes();
            $view->with([
                'listType' => $listType, 
                'provinces' => $provinces,
                'districts' => $districts,
                'wards' => $wards
            ]);
        });        
    }
}

