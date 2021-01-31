<?php

namespace App\Providers;

use App\Http\Payment\Fawry;
use App\Models\General\Page;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('fawry', function () {
            return new Fawry();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('siteName', function ($expression) {
            return  getSiteName();
        });

        view()->composer('site.layouts.app', function ($view) {
            $view->with([
                'footerPages' => Page::with('translations')->get(),
                'site_social' => socialSettings()
            ]);

            if (auth()->check()) {
                $view->with([
                    "wishlist" => auth()->user()->wishlist()->with(["product"])->get()
                ]);
            }
        });
    }
}
