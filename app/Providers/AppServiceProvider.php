<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
            
            $view->with('header', $header);
        });
    }
}
