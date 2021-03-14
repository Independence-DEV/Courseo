<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\App\AppController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\App\PostController as AppPostController;
use App\Http\Controllers\App\CourseController as AppCourseController;
use App\Http\Controllers\Account\PostController as AccountPostController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});

Route::middleware('web')->domain(env('APP_URL'))->group(function (){
    Route::name('welcome')->get('/', [WelcomeController::class, 'welcome']);
    Route::name('LangChange')->get('lang/{locale}', [LocalizationController::class, 'lang']);
});

Route::group(['domain' => env('APP_URL'),'prefix' => 'app', 'middleware' => 'auth'], function() {
    Route::name('app.settings')->get('/settings', [AppController::class, 'dashboard']);
    Route::name('app.dashboard')->get('/', [AppController::class, 'dashboard']);

    Route::name('app.website')->get('/website', [AppController::class, 'website']);
    Route::name('app.website.config')->get('/website/config', [AppController::class, 'website']);
    Route::name('app.website.config.edit')->post('/website/config/edit', [AppController::class, 'configEdit']);
    Route::name('app.website.indexPage')->get('/website/indexPage', [AppController::class, 'indexPage']);
    Route::name('app.website.indexPage.edit')->post('/website/indexPage/edit', [AppController::class, 'indexPageEdit']);
    Route::name('app.website.contactPage')->get('/website/contactPage', [AppController::class, 'contactPage']);

    Route::name('app.blog.posts')->get('/blog/posts', [AppPostController::class, 'posts']);
    Route::name('app.blog.post.create')->get('/blog/post/create', [AppPostController::class, 'create']);
    Route::name('app.blog.post.store')->post('/blog/post/store', [AppPostController::class, 'store']);
    Route::name('app.blog.post.edit')->get('/blog/post/edit/{id}', [AppPostController::class, 'edit']);
    Route::name('app.blog.categories')->get('/blog/categories', [AppPostController::class, 'posts']);
    Route::name('app.blog.categories.create')->get('/blog/category/create', [AppPostController::class, 'create']);
    Route::name('app.blog.categories.store')->post('/blog/category/store', [AppPostController::class, 'store']);
    Route::name('app.blog.categories.edit')->get('/blog/category/edit/{id}', [AppPostController::class, 'edit']);

    Route::name('app.courses.list')->get('/courses/list', [AppCourseController::class, 'courses']);
    Route::name('app.courses.course.create')->get('/courses/course/create', [AppCourseController::class, 'create']);
    Route::name('app.courses.course.store')->post('/courses/course/store', [AppCourseController::class, 'store']);
    Route::name('app.courses.course.edit')->get('/courses/course/edit/{id}', [AppCourseController::class, 'edit']);
    Route::name('app.courses.course.edit.chapter.create')->get('/courses/course/edit/{id}/chapter/create', [AppCourseController::class, 'createChapter']);
    Route::name('app.courses.course.edit.chapter.store')->get('/courses/course/edit/{id}/chapter/store', [AppCourseController::class, 'storeChapter']);
});
