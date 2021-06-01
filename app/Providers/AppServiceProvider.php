<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Prevenir erros ao usar asset() no heroku
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        //Prevenir erros de column size em migrations no heroku
        Schema::defaultStringLength(191);

    }
}
