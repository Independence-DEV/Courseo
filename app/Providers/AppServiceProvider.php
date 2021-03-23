<?php

namespace App\Providers;

use App\models\Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\SubscriptionItem;

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
        Cashier::useSubscriptionModel(Subscription::class);
        Cashier::useSubscriptionItemModel(SubscriptionItem::class);
    }
}
