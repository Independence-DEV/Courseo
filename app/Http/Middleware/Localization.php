<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $languages = array_keys(config('app.languages'));
        $locale = session()->get('locale');
        if(!is_null($locale)) App::setLocale($locale);
        else App::setLocale(app()->getLocale());
        return $next($request);
    }
}
