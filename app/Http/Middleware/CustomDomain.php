<?php

namespace App\Http\Middleware;

use App\Models\Config;
use App\Models\ConfigPayment;
use App\Models\ContactPage;
use App\Models\Course;
use App\Models\CustomPage;
use App\Models\Post;
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
        $domain = str_replace('www.', '', $request->getHost());
        $account = Account::where('domain', $domain)->firstOrFail();
        $config = Config::where('account_id', $account->id)->firstOrFail();
        $courseNumber = Course::where('account_id', $account->id)->whereActive(true)->count();
        $postNumber = Post::where('account_id', $account->id)->whereActive(true)->count();
        $customPages = CustomPage::where('account_id', $account->id)->get();
        $contactPage = ContactPage::where('account_id', $account->id)->firstOrFail();
        $configPayment = ConfigPayment::where('account_id', $account->id)->firstOrFail();

        config(['account.account_id' => $account->id]);

        // Append domain and tenant to the Request object
        // for easy retrieval in the application.
        $request->merge([
            'domain' => $domain,
            'account' => $account,
            'configPayment' => $configPayment,
        ]);

        // Share tentant data with your views for easier
        // customization across the board
        View::share('account', $account);
        View::share('domain', $domain);
        View::share('config', $config);
        View::share('configPayment', $configPayment);
        View::share('courseNumber', $courseNumber);
        View::share('postNumber', $postNumber);
        View::share('customPages', $customPages);
        View::share('contactPage', $contactPage);

        return $next($request);
    }
}
