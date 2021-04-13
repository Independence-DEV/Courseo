<?php

use App\Http\Controllers\Account\AccountController as AccountController;
use App\Http\Controllers\Account\PostController as AccountPostController;
use App\Http\Controllers\Account\CourseController as AccountCourseController;
use App\Http\Controllers\Account\MemberAreaController as MemberAreaController;
use App\Http\Controllers\Account\CustomerAuthController;
use Illuminate\Support\Facades\Route;

Route::pattern('domain', '^((?!www).)*$');

Route::middleware('subdomain')->domain('{domain}.'.env('APP_DOMAIN'))->group(function (){
    Route::name('account.index')->get('/', [AccountPostController::class, 'index']);
    Route::name('account.contact')->get('/contact', [AccountController::class, 'contact']);
    Route::name('account.contact.send')->post('/contact/send', [AccountController::class, 'contactSend']);
    Route::name('account.posts')->get('/posts', [AccountPostController::class, 'posts']);
    Route::name('account.post')->get('/post/{slug}', [AccountPostController::class, 'post']);
    Route::name('account.courses')->get('/courses', [AccountCourseController::class, 'courses']);
    Route::name('account.course')->get('/course/{slug}', [AccountCourseController::class, 'course']);
    Route::name('account.course')->post('/course/{slug}', [AccountCourseController::class, 'course']);
    Route::name('account.page')->get('/page/{slug}', [AccountController::class, 'page']);

    Route::name('account.memberarea.course.payment')->get('/memberarea/course/{courseSlug}/payment', [MemberAreaController::class, 'paymentCourse']);
    Route::name('account.memberarea.course.processpayment')->post('/memberarea/course/{courseSlug}/processpayment/{prospectId}', [MemberAreaController::class, 'processPaymentCourse']);

    Route::name('account.memberarea.home')->get('/memberarea', [MemberAreaController::class, 'home'])->middleware('auth:webcustomer');
    Route::name('account.memberarea.login')->get('/memberarea/login', [CustomerAuthController::class, 'login']);
    Route::name('account.memberarea.handleLogin')->post('/memberarea/login', [CustomerAuthController::class, 'handleLogin']);
    Route::name('account.memberarea.logout')->get('/memberarea/logout', [CustomerAuthController::class, 'logout']);
    Route::name('account.memberarea.course')->get('/memberarea/course/{slug}', [MemberAreaController::class, 'course'])->middleware('auth:webcustomer');
    Route::name('account.memberarea.lesson')->get('/memberarea/course/{slug}/chapter/{chapterSlug}/lesson/{lessonSlug}', [MemberAreaController::class, 'lesson'])->middleware('auth:webcustomer');
});
