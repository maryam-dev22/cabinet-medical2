<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromSession
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check URL parameter first
        if ($request->has('locale') && in_array($request->get('locale'), ['en', 'fr'])) {
            app()->setLocale($request->get('locale'));
            session()->put('locale', $request->get('locale'));
        }
        // Then check cookie
        elseif ($request->cookie('locale') && in_array($request->cookie('locale'), ['en', 'fr'])) {
            app()->setLocale($request->cookie('locale'));
        }
        // Finally check session
        elseif (session()->has('locale') && in_array(session('locale'), ['en', 'fr'])) {
            app()->setLocale(session('locale'));
        }
        
        return $next($request);
    }
}
