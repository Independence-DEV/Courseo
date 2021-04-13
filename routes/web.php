<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\App\AppController;
use App\Http\Controllers\SubscriptionController;
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

Route::middleware('web')->domain(env('APP_DOMAIN'))->group(function (){
    Route::name('welcome')->get('/', [WelcomeController::class, 'welcome']);
    Route::name('LangChange')->get('lang/{locale}', [LocalizationController::class, 'lang']);
});

Route::group(['domain' => env('APP_DOMAIN'),'prefix' => 'app', 'middleware' => 'auth'], function() {
    Route::name('app.settings')->get('/settings', [AppController::class, 'settings']);
    Route::name('app.user.edit')->post('/settings/edit', [AppController::class, 'editUser']);
    Route::name('app.dashboard')->get('/', [AppController::class, 'dashboard']);
    Route::name('app.subscriptions')->get('/subscriptions', [SubscriptionController::class, 'showSubscription']);

    Route::name('app.website')->get('/website', [AppController::class, 'website']);
    Route::name('app.website.config')->get('/website/config', [AppController::class, 'website']);
    Route::name('app.website.config.edit')->post('/website/config/edit', [AppController::class, 'configEdit']);
    Route::name('app.website.indexPage')->get('/website/indexPage', [AppController::class, 'indexPage']);
    Route::name('app.website.indexPage.edit')->post('/website/indexPage/edit', [AppController::class, 'indexPageEdit']);
    Route::name('app.website.contactPage')->get('/website/contactPage', [AppController::class, 'contactPage']);
    Route::name('app.website.contactPage.edit')->post('/website/contactPage/edit', [AppController::class, 'contactPageEdit']);
    Route::name('app.website.custompage.list')->get('/website/custompage/list', [AppController::class, 'customPageList']);
    Route::name('app.website.custompage.create')->get('/website/custompage/create', [AppController::class, 'customPageCreate']);
    Route::name('app.website.custompage.store')->post('/website/custompage/store', [AppController::class, 'customPageStore']);
    Route::name('app.website.custompage.edit')->get('/website/custompage/edit/{id}', [AppController::class, 'customPageEdit']);
    Route::name('app.website.custompage.update')->put('/website/custompage/update/{id}', [AppController::class, 'customPageUpdate']);
    Route::name('app.website.custompage.destroy')->delete('/website/custompage/destroy/{id}', [AppController::class, 'customPageDestroy']);
    Route::name('app.website.template')->get('/website/template', [AppController::class, 'template']);

    Route::name('app.blog.posts')->get('/blog/posts', [AppPostController::class, 'posts']);
    Route::name('app.blog.post.create')->get('/blog/post/create', [AppPostController::class, 'create']);
    Route::name('app.blog.post.store')->post('/blog/post/store', [AppPostController::class, 'store']);
    Route::name('app.blog.post.edit')->get('/blog/post/edit/{id}', [AppPostController::class, 'edit']);
    Route::name('app.blog.post.update')->put('/blog/post/update/{id}', [AppPostController::class, 'update']);
    Route::name('app.blog.post.destroy')->delete('/blog/post/destroy/{id}', [AppPostController::class, 'destroy']);

    Route::name('app.blog.categories.index')->get('/blog/categories', [AppPostController::class, 'categories']);
    Route::name('app.blog.categories.store')->post('/blog/categories/store', [AppPostController::class, 'categories_store']);
    Route::name('app.blog.categories.edit')->get('/blog/categories/edit/{id}', [AppPostController::class, 'categories_edit']);
    Route::name('app.blog.categories.update')->put('/blog/categories/update/{id}', [AppPostController::class, 'categories_update']);

    Route::name('app.courses.paymentConfig')->get('/courses/paymentConfig', [AppCourseController::class, 'paymentConfig']);
    Route::name('app.courses.paymentConfig.update')->post('/courses/paymentConfig/update', [AppCourseController::class, 'paymentConfig_update']);
    Route::name('app.courses.list')->get('/courses/list', [AppCourseController::class, 'courses']);
    Route::name('app.courses.course.create')->get('/courses/course/create', [AppCourseController::class, 'create']);
    Route::name('app.courses.course.store')->post('/courses/course/store', [AppCourseController::class, 'store']);
    Route::name('app.courses.course.update')->post('/courses/course/update/{id}', [AppCourseController::class, 'update']);
    Route::name('app.courses.course.edit')->get('/courses/course/edit/{id}', [AppCourseController::class, 'edit']);
    Route::name('app.courses.course.edit.chapter.create')->get('/courses/course/edit/{id}/chapter/create', [AppCourseController::class, 'createChapter']);
    Route::name('app.courses.course.edit.chapter.store')->post('/courses/course/edit/{id}/chapter/store', [AppCourseController::class, 'storeChapter']);
    Route::name('app.courses.course.edit.lesson.create')->get('/courses/course/edit/{id}/lesson/create', [AppCourseController::class, 'createLesson']);
    Route::name('app.courses.course.edit.lesson.store')->post('/courses/course/edit/{id}/lesson/store', [AppCourseController::class, 'storeLesson']);
    Route::name('app.courses.course.edit.lesson.edit')->get('/courses/course/edit/{id}/lesson/edit/{lesson_id}', [AppCourseController::class, 'createLesson']);

    Route::name('app.courses.prospects')->get('/courses/prospects', [AppCourseController::class, 'prospects']);
    Route::name('app.courses.customers')->get('/courses/customers', [AppCourseController::class, 'customers']);
});

Route::group(['domain' => env('APP_DOMAIN'), 'prefix' => 'admin'], function() {
    Route::name('admin.login')->get('/login', [AdminController::class, 'login']);
    Route::name('admin.handleLogin')->post('/login', [AdminController::class, 'handleLogin']);
    Route::name('admin.logout')->get('/logout', [AdminController::class, 'logout']);
    Route::name('admin.dashboard')->get('/', [AdminController::class, 'dashboard'])->middleware('auth:admin');
    Route::name('admin.waitinglist')->get('/waitinglist', [AdminController::class, 'waitinglist'])->middleware('auth:admin');
    Route::name('admin.waitinglist.sendaccess')->get('/waitinglist/sendaccess/{id}', [AdminController::class, 'waitinglist_sendaccess'])->middleware('auth:admin');
    Route::name('admin.accounts')->get('/accounts', [AdminController::class, 'accounts'])->middleware('auth:admin');
});
