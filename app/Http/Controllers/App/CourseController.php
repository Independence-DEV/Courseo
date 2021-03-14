<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display list courses.
     *
     * @return \Illuminate\View\View
     */
    public function courses()
    {
        $courses = Course::where('account_id', Auth::user()->account_id)->paginate(5);
        return view('app.courses', compact('courses'));
    }

    /**
     * Create a post
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('app.course.create');
    }

    /**
     * Create a post
     *
     * @return \Illuminate\View\View
     */
    public function createChapter()
    {
        return view('app.course.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['account_id'] = Auth::user()->account_id;
        $id = Course::create($data)->id;
        return redirect()->route('app.courses.course.edit', ['id' => $id]);
    }

    /**
     * Edit a course
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $chapters = Chapter::where('course_id', $id)->orderBy('order')->get();
        $lessons = array();
        foreach ($chapters as $chapter){
            $lessons[$chapter->id] = Lesson::where('chapter_id', $chapter->id)->orderBy('order')->get();
        }
        return view('app.course.edit', compact('course', 'chapters', 'lessons'));
    }
}
