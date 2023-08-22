<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if(auth()->user()->role_id == '1') {
            $user_role = 'user';
        } elseif(auth()->user()->role_id == '2') {
            $user_role = 'modo';
        } elseif(auth()->user()->role_id == '3') {
            $user_role = 'admin';
        }

        if (in_array($user_role, $roles)) {
            return $next($request);
        }

        abort(403);
    }
}
