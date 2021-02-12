<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AccountController extends Controller
{
    /**
     * Display index page.
     *
     * @return \Illuminate\View\View
     */
    public function index($account_subdomain)
    {
        $account = Account::where('subdomain', $account_subdomain)->first();
        return view('account.index', compact('account'));
    }

    /**
     * Display blog page.
     *
     * @return \Illuminate\View\View
     */
    public function posts($account_subdomain)
    {
        $account = Account::where('subdomain', $account_subdomain)->first();
        $posts = Post::where('account_id', $account->id)->get();
        return view('account.posts', compact('account', 'posts'));
    }
}
