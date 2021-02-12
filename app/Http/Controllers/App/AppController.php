<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Display dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $account = Account::where('id', Auth::user()->account_id)->first();
        return view('app.dashboard', compact('account'));
    }
}
