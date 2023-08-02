<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        \Illuminate\Support\Facades\URL::defaults(['X-CSRF-TOKEN' => \Illuminate\Support\Facades\Request::header('X-CSRF-TOKEN')]);
        Schema::defaultStringLength(191);
        \URL::forceScheme('https');
    }
}
