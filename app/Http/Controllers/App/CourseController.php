<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\ConfigPayment;
use App\Models\Course;
use App\Models\Customer;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\Prospect;
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

    public function prospects()
    {
        $prospects = Prospect::where('account_id', Auth::user()->account_id)->paginate(5);
        return view('app.course.prospects', compact('prospects'));
    }

    public function customers()
    {
        $customers = Customer::where('account_id', Auth::user()->account_id)->paginate(5);
        return view('app.course.customers', compact('customers'));
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
    public function createChapter($id)
    {
        $course = Course::find($id);
        $chapters = Chapter::where('course_id', $id)->orderBy('order')->get();
        $lessons = array();
        foreach ($chapters as $chapter){
            $lessons[$chapter->id] = Lesson::where('chapter_id', $chapter->id)->orderBy('order')->get();
        }
        return view('app.course.chapter', compact('course', 'chapters', 'lessons'));
    }

    public function createLesson($id)
    {
        $course = Course::find($id);
        $chapters = Chapter::where('course_id', $id)->orderBy('order')->get();
        $lessons = array();
        foreach ($chapters as $chapter){
            $lessons[$chapter->id] = Lesson::where('chapter_id', $chapter->id)->orderBy('order')->get();
        }
        return view('app.course.lesson', compact('course', 'chapters', 'lessons'));
    }

    public function editLesson($id, $lesson_id)
    {
        return view('app.course.lesson');
    }

    public function store(Request $request)
    {
        $request->merge([
            'image' => parse_url($request->image, PHP_URL_PATH),
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['account_id'] = Auth::user()->account_id;
        $id = Course::create($data)->id;
        return redirect()->route('app.courses.course.edit', ['id' => $id]);
    }

    public function update($id, Request $request)
    {
        $request->merge([
            'image' => parse_url($request->image, PHP_URL_PATH),
        ]);
        $data = $request->all();
        $course = Course::find($id);
        $course->update($data);
        return redirect()->route('app.courses.course.edit', ['id' => $id]);
    }

    public function storeChapter($id, Request $request)
    {
        $data = $request->all();
        $data['course_id'] = $id;
        $chapters = Chapter::where('course_id', $id)->where('order', '>=', $data['order'])->orderBy('order')->get();
        if(count($chapters)){
            foreach($chapters as $chapter){
                $chapter->order++;
                $chapter->update();
            }
        }
        Chapter::create($data);
        return redirect()->route('app.courses.course.edit', ['id' => $id]);
    }

    public function storeLesson($id, Request $request)
    {
        $data = $request->all();
        $lessons = Lesson::where('chapter_id', $data['chapter_id'])->orderBy('order')->get();
        /*if(count($lessons)){
            foreach($lessons as $lesson){
                $lesson->order++;
                $lesson->update();
            }
        }*/
        $data['order'] = count($lessons)+1;
        Lesson::create($data);
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

    public function paymentConfig()
    {
        $configPayment = ConfigPayment::where('account_id', Auth::user()->account_id)->firstOrFail();
        return view('app.course.payment-config', compact('configPayment'));
    }

    public function paymentConfig_update(Request $request)
    {
        $data = $request->all();
        $configPayment = ConfigPayment::where('account_id', Auth::user()->account_id)->firstOrFail();
        $configPayment->update($data);
        return redirect('app/courses/paymentConfig');
    }
}
