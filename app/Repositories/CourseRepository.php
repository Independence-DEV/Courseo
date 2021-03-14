<?php

namespace App\Repositories;

use App\Models\{Course, Chapter, Lesson};
use Illuminate\Support\Str;

class CourseRepository
{
    public function getCourses()
    {
        $courses = Course::where('account_id', config('account.account_id'))
            ->whereActive(true)
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
}
