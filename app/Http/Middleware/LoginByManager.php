<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginByManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roleManager = config('constants.manager');

        $user =Auth::user();
        $role = $user->userHasRole->role_id;

        if ($role == $roleManager)
        {
            return $next($request);
        }
        else
        {
            dd(123);
            return redirect()->route('statistic');
        }
    }
}
