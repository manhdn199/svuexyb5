<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckLogin
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
        $user = Auth::user();
        $user_id = $user->id;
        $role = DB::table('user_has_role')
            ->select('role_id')
            ->where('user_id', '=',$user_id)
            ->first();

        if ($role == null)
        {
            $request->session()->flush();
            return redirect()->route('login')->with(csrf_token());
        }

        if (!Auth::check())
        {
            return redirect()->route('login')->with(csrf_token());
        }
        else
        {
            return $next($request);
        }
    }
}
