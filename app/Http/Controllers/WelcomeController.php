<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $langs = array_diff(config('app.languages'), [app()->getLocale() => config('app.languages')[app()->getLocale()]]);
        return view('welcome', compact('langs'));
    }
}
