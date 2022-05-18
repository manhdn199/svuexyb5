<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginByAdmin
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
        $roleAdmin = config('constants.admin');

        $user =Auth::user();
        $role = $user->userHasRole->role_id;

        if (!($role == $roleAdmin))
        {
            return redirect()->route('statistic');
        }
        else
        {
            return $next($request);

        }

    }
}
