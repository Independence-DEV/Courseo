<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Config;
use App\Models\IndexPage;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function settings()
    {
        $user = Auth::user();
        return view('app.settings', compact('user'));
    }

    public function editUser(Request $request)
    {
        $data = $request->all();
        $this->validate($request, ['name' => 'required|string', 'email' => 'required|email']);
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $user->update($data);
        return redirect('app/settings');
    }

    /**
     * Display website.
     *
     * @return \Illuminate\View\View
     */
    public function website()
    {
        $account = Account::where('id', Auth::user()->account_id)->first();
        $config = Config::where('account_id', Auth::user()->account_id)->first();
        $langs = config('app.languages_full');
        return view('app.website', compact('account', 'config', 'langs'));
    }

    /**
     * Display courses management page.
     *
     * @return \Illuminate\View\View
     */
    public function courses()
    {
        return view('app.courses');
    }


    /**
     * Edit config account.
     *
     * @return \Illuminate\View\View
     */
    public function configEdit(Request $request)
    {
        $request->merge([
            'logo' => parse_url($request->logo, PHP_URL_PATH),
        ]);
        $data = $request->all();
        $this->validate($request, ['name' => 'required']);
        $account = Account::where('id', Auth::user()->account_id)->firstOrFail();
        $config = Config::where('account_id', Auth::user()->account_id)->firstOrFail();
        $account->update($data);
        $config->update($data);
        return redirect('app/website/config');
    }

    /**
     * Index Page.
     *
     * @return \Illuminate\View\View
     */
    public function indexPage()
    {
        $account = Account::where('id', Auth::user()->account_id)->first();
        $indexPage = IndexPage::where('account_id', Auth::user()->account_id)->firstOrFail();
        return view('app.website.index-page', compact('account', 'indexPage'));
    }

    /**
     * Index Page.
     *
     * @return \Illuminate\View\View
     */
    public function indexPageEdit(Request $request)
    {
        $data = $request->all();
        //$this->validate($request, ['content' => 'required']);
        $account = Account::where('id', Auth::user()->account_id)->firstOrFail();
        $indexPage = IndexPage::where('account_id', Auth::user()->account_id)->firstOrFail();
        $indexPage->update($data);
        return redirect('app/website/indexPage');
    }

    /**
     * Index Page.
     *
     * @return \Illuminate\View\View
     */
    public function contactPage()
    {
        $account = Account::where('id', Auth::user()->account_id)->first();
        return view('app.website.contact-page', compact('account'));
    }
}
