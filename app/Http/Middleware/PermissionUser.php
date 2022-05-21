<?php

namespace App\Http\Middleware;

use App\Models\RoleHasPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionUser
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
        $roleManager = config('constants.manager');
        $perUser = config('constants.Users');
        $user =Auth::user();
        $role = $user->userHasRole->role_id;

        $permissionInRole = RoleHasPermission::select('*')
            ->where('role_id','=',$role)
            ->get();

        foreach ($permissionInRole as $value)
        {
            if($value->permission_id == $perUser)
            {
                return $next($request);
            }
        }

        if ($role == $roleAdmin || $role == $roleManager)
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('statistic');
        }
    }
}
