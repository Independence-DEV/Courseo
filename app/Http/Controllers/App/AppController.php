<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Config;
use App\Models\Course;
use App\Models\Customer;
use App\Models\CustomPage;
use App\Models\IndexPage;
use App\Models\Post;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Object_;
use stdClass;

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
        $data = new stdClass();
        $data->nbProspects = Prospect::where('account_id', Auth::user()->account_id)->count();
        $data->nbCustomers = Customer::where('account_id', Auth::user()->account_id)->count();
        $data->nbPosts = Post::where('account_id', Auth::user()->account_id)->count();
        $data->nbCourses = Course::where('account_id', Auth::user()->account_id)->count();
        return view('app.dashboard', compact('account', 'data'));
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
        if(isset($data['active_posts']) && ($data['active_posts'] == 'on')) $data['active_posts'] = 1;
        else $data['active_posts'] = 0;
        //$this->validate($request, ['content' => 'required']);
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
        return view('app.website.contactpage', compact('account'));
    }

    public function customPageList()
    {
        $account = Account::where('id', Auth::user()->account_id)->first();
        $customPages = $account->customPages()->paginate(10);
        return view('app.website.custompage-list', compact('customPages'));
    }

    public function customPageCreate()
    {
        return view('app.website.custompage-create');
    }

    public function customPageStore(Request $request)
    {
        $data = $request->all();
        $data['account_id'] = Auth::user()->account_id;
        CustomPage::create($data);
        return redirect('app/website/custompage/list');
    }

    public function customPageEdit($id)
    {
        $customPage = CustomPage::where('id', $id)->first();
        return view('app.website.custompage-edit', compact('customPage'));
    }

    public function customPageUpdate($id, Request $request)
    {
        $data = $request->all();
        $post = CustomPage::find($id);
        $post->update($data);
        return redirect('app/website/custompage/list');
    }

    public function customPageDestroy()
    {
        $account = Account::where('id', Auth::user()->account_id)->first();
        $customPages = $account->customPages()->paginate(10);
        return view('app.website.custompage-list', compact('customPages'));
    }


    public function template()
    {
        $account = Account::where('id', Auth::user()->account_id)->first();
        return view('app.website.template', compact('account'));
    }
}
