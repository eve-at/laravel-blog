<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // user must log in first
        if (! auth()->user()) {
            return redirect()->route('login');
        }

        // user have no admin rights
        if (! auth()->user()?->admin) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
