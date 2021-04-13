<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ContactPage;
use App\Models\Course;
use App\Models\CustomPage;
use App\Repositories\CourseRepository;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $courses = $this->courseRepository->getCourses();
        return view('account.courses', compact('courses'));
    }

    public function page($domain, $slug)
    {
        $page = CustomPage::whereSlug($slug)->where('account_id', config('account.account_id'))->firstOrFail();
        return view('account.page', compact('page'));
    }

    public function contact(Request $request)
    {
        $contactPage = ContactPage::where('account_id', config('account.account_id'))->firstOrFail();
        if($contactPage->active) return view('account.contact');
        return redirect()->route('account.index', $request->domain);
    }

    public function contactSend(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => ['required', new Recaptcha()],
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        $data = $request->all();
        ContactMessage::create($data);
        return redirect()->route('account.contact', $request->domain);
    }
}
