<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('DEFAULT_USER_IMG', 'https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario');
        View::share('APP_NAME', config('app.name'));

        // Image Directories
        View::share('PROFILE_IMG', 'profile');
        View::share('POST_IMG', 'post');
    }
}
