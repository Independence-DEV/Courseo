<?php

use App\Http\Controllers\Account\AccountController as AccountController;
use App\Http\Controllers\Account\PostController as AccountPostController;
use App\Http\Controllers\Account\CourseController as AccountCourseController;
use Illuminate\Support\Facades\Route;


Route::middleware('subdomain')->domain('{account_subdomain}.'.env('APP_URL'))->group(function (){
    Route::name('account.index')->get('/', [AccountPostController::class, 'index']);
    Route::name('account.contact')->get('/contact', [AccountController::class, 'contact']);
    Route::name('account.posts')->get('/posts', [AccountPostController::class, 'posts']);
    Route::name('account.post')->get('/post/{slug}', [AccountPostController::class, 'post']);
    Route::name('account.courses')->get('/courses', [AccountCourseController::class, 'courses']);
    Route::name('account.course')->get('/course/{slug}', [AccountCourseController::class, 'course']);
    Route::name('account.course')->post('/course/{slug}', [AccountCourseController::class, 'course']);

});
