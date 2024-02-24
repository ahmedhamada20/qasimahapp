<?php

namespace App\Providers;

use App\Models\SeoPage;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // get url of current page into appServiceProvider

        view()->composer('*', function ($view) {
            $uri = request()->path();
            $view->with('page', SeoPage::where('uri','LIKE',"%$uri%")->first());

            $siteBanner = Setting::first()->site_banner_path;
            $view->with('siteBanner',$siteBanner);
        });
    }
}
