<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendAccess;
use App\Models\Account;
use App\Models\User;
use App\Models\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.home');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function handleLogin(Request $request)
    {
        if(Auth::guard('admin')
            ->attempt($request->only(['email', 'password'])))
        {
            return redirect()->route('admin.dashboard');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')
            ->logout();

        return redirect()
            ->route('admin.login');
    }

    public function waitinglist()
    {
        $waitinglist = WaitingList::paginate(40);
        return view('admin.waitinglist', compact('waitinglist'));
    }

    public function waitinglist_sendaccess($id, Request $request)
    {
        $prospect = WaitingList::where('id', $id)->first();
        Mail::to($prospect->email)
            ->send(new SendAccess($prospect));
        return redirect()->back();
    }

    public function accounts()
    {
        $users = User::paginate(40);
        return view('admin.accounts', compact('users'));
    }
}
