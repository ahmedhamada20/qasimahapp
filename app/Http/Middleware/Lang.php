<?php

namespace App\Http\Middleware;

use Closure;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = \Request::segment(1);

        if ($locale == \Config::get('app.available_locales')) {
            \App::setLocale($locale);

        } else {
            \App::setLocale("ar");
            $locale = null;

        }
//        App::setLocale(Session::has('language') ? Session::get('language') : Config::get('app.locale'));
        return $next($request);
    }
}
