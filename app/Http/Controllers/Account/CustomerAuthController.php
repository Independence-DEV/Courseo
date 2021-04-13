<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function index()
    {
        return view('memberarea.home');
    }

    public function login()
    {
        return view('memberarea.login');
    }

    public function handleLogin(Request $request)
    {
        if(Auth::guard('webcustomer')
            ->attempt($request->only(['email', 'password', 'account_id'])))
        {
            return redirect()->route('account.memberarea.home', $request->domain);
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('webcustomer')
            ->logout();

        return redirect()
            ->route('account.memberarea.login', $request->domain);
    }
}
