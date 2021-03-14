<?php

namespace App\Providers;

use App\models\Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        /*$test = Route::getCurrentRoute()->getParameter('subdomain');
        View::composer(['account.index'], function ($view) {
            $view->with('account', Account::where('subdomain', Route::getCurrentRoute()->getParameter('subdomain'))->firstOrFail()());
        });*/
    }
}
