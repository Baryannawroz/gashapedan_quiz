<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
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
    

    public function boot()
    {
        Blade::directive('setLocale', function ($expression) {
            $locale = Session::get('locale') ?? config('app.locale');
            return "<?php App::setLocale($locale); ?>";
        });
    }

}
