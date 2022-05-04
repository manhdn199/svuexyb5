<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class CheckAdminLogin
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
//        $user = User::where(
//            'email', $request->email
//        )->first();

        $user = auth('sanctum')->user();

        if (!empty($user))
        {
            $role = $user->userHasRole->role_id;

            if ($role == Role::ADMIN)
            {
                return $next($request);
            }
        }

        return redirect()->route('getLogin');
    }
}
