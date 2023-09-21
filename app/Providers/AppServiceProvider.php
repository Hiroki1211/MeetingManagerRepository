<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https'); //追加
        if (request()->is('client/*')) {
            config(['session.cookie' => config('session.cookie_client')]);
        }
        if (request()->is('admin/*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        }
    }
}
