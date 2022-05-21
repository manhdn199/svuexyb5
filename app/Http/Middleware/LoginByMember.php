<?php

namespace App\Http\Middleware;

use App\Models\RoleHasPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginByMember
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
        $roleMember = config('constants.member');
        $reportsByEm = config('constants.ReportsByEm');
        $user =Auth::user();
        $role = $user->userHasRole->role_id;

        $permission = RoleHasPermission::select('*')
            ->where('role_id','=',$role)
            ->get();

        foreach($permission as $value)
        {
            if ($value->permission_id == $reportsByEm)
            {
                return $next($request);
            }
        }

        if ($role == $roleMember)
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('statistic');
        }
    }
}
