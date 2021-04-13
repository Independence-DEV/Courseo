<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request)
    {
        $test = $request->getHost();
        if (! $request->expectsJson()) {
            if ($request->routeIs('account.memberarea.*')) {
                return route('account.memberarea.login', $request->getHost());
            } else if($request->routeIs('admin.*')){
                return route('admin.login');
            }
            return route('login');
        }
    }
}
