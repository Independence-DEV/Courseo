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

        $test = $course->title;

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

    public function processPaymentCourse($account_subdomain, $courseSlug, $prospectId, Request $request)
    {
        $data = $request->all();
        $test = $data['client_secret'];
        $stripe = new \Stripe\StripeClient(
            'sk_test_aitKH26s2pO2HK1KbZrMkUWf'
        );
        $stripe->paymentIntents->confirm(
            $data['stripe_id'],
            ['payment_method' => 'pm_card_visa']
        );
    }

    public function home($account_subdomain)
    {
        $customer = Auth::guard('webcustomer');
        $courses = Customer::where('id', $customer->id())->firstOrFail()->courses()->get();
        return view('memberarea.home', compact('courses'));
    }

    public function course($account_subdomain, $courseSlug)
    {
        $course = $this->courseRepository->getCourseBySlug($courseSlug);
        $chapters = Chapter::where('course_id', $course->id)->orderBy('order')->get();
        $lessons = array();
        foreach ($chapters as $chapter){
            $lessons[$chapter->id] = Lesson::where('chapter_id', $chapter->id)->orderBy('order')->get();
        }
        return view('memberarea.course', compact('course', 'chapters', 'lessons'));
    }

    public function lesson($account_subdomain, $courseSlug, $lessonSlug)
    {
        $course = $this->courseRepository->getCourseBySlug($courseSlug);
        $chapters = Chapter::where('course_id', $course->id)->orderBy('order')->get();
        $lessons = array();
        foreach ($chapters as $chapter){
            $lessons[$chapter->id] = Lesson::where('chapter_id', $chapter->id)->orderBy('order')->get();
        }
        $currentLesson = Lesson::whereSlug($lessonSlug)->firstOrFail();
        return view('memberarea.lesson', compact('course', 'chapters', 'lessons', 'currentLesson'));
    }
}
