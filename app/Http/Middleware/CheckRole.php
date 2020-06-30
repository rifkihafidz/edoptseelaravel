<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)
    {
        if(in_array($request->user()->role, $roles)) {
            return $next($request);
        }
        switch(auth()->user()->role) {
            case 'admin':
                return redirect('/dashboard');
            break;
            case 'user':
                return redirect('/');
            break;
        } 
    }

    // if(Auth::user() && Auth::user()->roles =='admin') {
    //     return $next($request);
    // }
}
