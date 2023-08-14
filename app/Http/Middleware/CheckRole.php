<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if($role == 'user' && auth()->user()->role_id == '1') {
            return $next($request);
        }
        if($role == 'modo' && auth()->user()->role_id == '2') {
            return $next($request);
        }
        if($role == 'admin' && auth()->user()->role_id == '3') {
            return $next($request);
        }
        abort(403);
    }
}
