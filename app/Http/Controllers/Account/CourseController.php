<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Display index page.
     *
     * @return \Illuminate\View\View
     */
    public function courses()
    {
        $courses = $this->courseRepository->getCourses();
        return view('account.courses', compact('courses'));
    }

    public function course($account_subdomain, $slug)
    {
        $course = $this->courseRepository->getCourseBySlug($slug);
        return view('account.course', compact('course'));
    }
}
