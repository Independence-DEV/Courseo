<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Customer;
use App\Models\Lesson;
use App\Models\Prospect;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Stripe;

class MemberAreaController extends Controller
{
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function paymentCourse($courseSlug, Request $request)
    {
        $course = Course::whereSlug($courseSlug)
            ->where('account_id', config('account.account_id'))
            ->firstOrFail();
        $prospect = Prospect::whereEmail($request->prospectEmail)
            ->where('account_id', config('account.account_id'))
            ->firstOrFail();

        $stripe = new \Stripe\StripeClient(
            'sk_test_aitKH26s2pO2HK1KbZrMkUWf'
        );
        $intent = $stripe->paymentIntents->create([
            'amount' => intval($course->price)*100,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'description' => $course->title,
        ]);
        return view('memberarea.payment', compact('course', 'prospect', 'intent'));
    }

    public function processPaymentCourse($domain, $courseSlug, $prospectId, Request $request)
    {
        $data = $request->all();
        $stripe = new \Stripe\StripeClient(
            'sk_test_aitKH26s2pO2HK1KbZrMkUWf'
        );
        $paymentIntent = $stripe->paymentIntents->retrieve(
            $data['stripe_id']
        );
        if($paymentIntent->status == "succeeded"){
            $course = Course::whereSlug($courseSlug)
                ->where('account_id', config('account.account_id'))
                ->firstOrFail();
            if(is_null($customer = Customer::whereEmail($data['email'])->where('account_id', config('account.account_id'))->first())) {
                $customer = Customer::create(['email' => $data['email'], 'name' => $data['name'], 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'account_id' => config('account.account_id')]);
                $customer->courses()->sync($course);
            } else {
                $customer->courses()->sync($course);
            }
            $prospect = Prospect::whereEmail($data['email'])->where('account_id', config('account.account_id'))->first();
            $prospect->delete();
            return redirect()->route('account.memberarea.home', $request->route('domain'));
        } else return redirect()->back();
    }

    public function home($domain)
    {
        $customer = Auth::guard('webcustomer');
        $courses = Customer::where('id', $customer->id())->firstOrFail()->courses()->get();
        return view('memberarea.home', compact('courses'));
    }

    public function course($domain, $courseSlug)
    {
        $course = $this->courseRepository->getCourseActiveBySlug($courseSlug);
        $chapters = Chapter::where('course_id', $course->id)->orderBy('order')->get();
        $lessons = array();
        foreach ($chapters as $chapter){
            $lessons[$chapter->id] = Lesson::where('chapter_id', $chapter->id)->orderBy('order')->get();
        }
        return view('memberarea.course', compact('course', 'chapters', 'lessons'));
    }

    public function lesson($domain, $courseSlug, $chapterSlug, $lessonSlug)
    {
        $course = $this->courseRepository->getCourseActiveBySlug($courseSlug);
        $chapters = Chapter::where('course_id', $course->id)->orderBy('order')->get();
        $lessons = array();
        foreach ($chapters as $chapter){
            $lessons[$chapter->id] = Lesson::where('chapter_id', $chapter->id)->orderBy('order')->get();
        }
        $currentChapter = Chapter::whereSlug($chapterSlug)->where('course_id', $course->id)->firstOrFail();
        $currentLesson = Lesson::whereSlug($lessonSlug)->where('chapter_id', $currentChapter->id)->firstOrFail();
        return view('memberarea.lesson', compact('course', 'chapters', 'lessons', 'currentLesson'));
    }
}
