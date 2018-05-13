<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Modification for Mysql specified key is too long error
        Schema::defaultStringLength(191);
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            Config::set('apiuser', User::where('username', $_SERVER['PHP_AUTH_USER'])->first()->id);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
