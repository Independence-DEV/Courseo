<?php

namespace App\Repositories;

use App\Models\{Course, Chapter, Lesson};
use Illuminate\Support\Str;

class CourseRepository
{
    public function getCustomersCourses($customer)
    {
        $courses = Course::where('account_id', config('account.account_id'))
            ->whereActive(true)
            ->customers()
            ->get();
        return $courses;
    }

    public function getActiveCourses()
    {
        $courses = Course::where('account_id', config('account.account_id'))
            ->whereActive(true)
            ->get();
        return $courses;
    }

    public function getCourses()
    {
        $courses = Course::where('account_id', config('account.account_id'))
            ->get();
        return $courses;
    }

    public function getCourseBySlug($slug)
    {
        $course = Course::whereSlug($slug)
            ->where('account_id', config('account.account_id'))
            ->firstOrFail();
        return $course;
    }

    public function getCourseActiveBySlug($slug)
    {
        $course = Course::whereSlug($slug)
            ->where('account_id', config('account.account_id'))
            ->whereActive(true)
            ->firstOrFail();
        return $course;
    }
}
