<?php

namespace App\Http\Middleware;

use App\Models\RoleHasPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginByManagerOrAdmin
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

        $user =Auth::user();
        $role = $user->userHasRole->role_id;

        $permissionInRole = RoleHasPermission::sortable()
            ->select('permission_id')
            ->where('role_id','=',$role)
            ->join('roles', 'roles.id', '=', 'role_has_permission.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_has_permission.permission_id')
            ->get();

        foreach ($permissionInRole as $value)
        {
            $arrayPermission = $value->permission_id;
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
