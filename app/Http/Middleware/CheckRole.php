<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next): Response
    {
        if (Auth::check() && $request->user()->authorizeRoles(['admin'])) {
            return $next($request);
        }
        return redirect('home');
    }
}
