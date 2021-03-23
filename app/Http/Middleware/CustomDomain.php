<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CustomDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $domain = $request->route('account_domain');
        $account = Account::where('domain', $domain)->firstOrFail();
        $config = Config::where('account_id', $account->id)->firstOrFail();

        config(['account.account_id' => $account->id]);

        // Append domain and tenant to the Request object
        // for easy retrieval in the application.
        $request->merge([
            'domain' => $domain,
            'account' => $account,
        ]);

        // Share tentant data with your views for easier
        // customization across the board
        View::share('account', $account);
        View::share('config', $config);

        return $next($request);
    }
}
