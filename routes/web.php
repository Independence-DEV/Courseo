<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\App\AppController;
use App\Http\Controllers\App\AppPostController;
use Illuminate\Support\Facades\Route;
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

Route::middleware('web')->domain(env('APP_URL'))->group(function (){
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['prefix' => 'app', 'middleware' => 'auth'], function() {
    Route::get('/', [AppController::class, 'dashboard'])->name('app.dashboard');
    Route::get('/website', [AppController::class, 'website'])->name('app.website');
    Route::get('/posts', [AppPostController::class, 'posts'])->name('app.posts');
    Route::get('/post/create', [AppPostController::class, 'create'])->name('app.post.create');
    Route::post('/post/store', [AppPostController::class, 'store'])->name('app.post.store');
    Route::get('/post/edit/{id}', [AppPostController::class, 'edit'])->name('app.post.edit');
    Route::get('/courses', [AppController::class, 'courses'])->name('app.courses');
    Route::get('/settings', [AppController::class, 'settings'])->name('app.settings');
});

Route::middleware('web')->domain('{account_subdomain}.'.env('APP_URL'))->group(function (){
    Route::get('/', [AccountController::class, 'index'])->name('account.index');
    Route::get('/posts', [AccountController::class, 'posts'])->name('account.posts');
});



