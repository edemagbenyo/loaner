<?php

namespace App\Providers;

use App\Observers\PriceObserver;
use App\Observers\UserObserver;
use App\Price;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        //Register an observer
        User::observe(UserObserver::class);
        Price::observe(PriceObserver::class);
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
