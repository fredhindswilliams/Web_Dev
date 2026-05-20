<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ImageFetcher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(ImageFetcher::class, function () {
            return new ImageFetcher();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
