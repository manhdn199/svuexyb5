<?php

namespace App\Http\Controllers\Auth;

use App\Charts\StatisticPositionChart;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\Report;
use App\Models\User;
use App\Models\UserhasRole;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    // view home with statistic
    public function StatisticProject(Request $request)
    {
        $roleAdmin = config('constants.admin');
        $roleManage = config('constants.manager');
        $roleMember = config('constants.member');
        $startByMonth = config('constants.start');

        $user = Auth::user();
        $user_id = $user->id;
        $role = DB::table('user_has_role')
            ->select('role_id')
            ->where('user_id', '=',$user_id)
            ->first();

        if(empty($role) ){
            \cache()->flush();

            return view('auth/login');

        }

        $role = $user->userHasRole->role_id;

        if ($role == $roleAdmin || $role == $roleManage) {
            $projects = DB::table('projects')
                ->get();

            $users = DB::table('users')
                ->get();

            $positions = DB::table('positions')
                ->get();

            if (!empty($request->project_id)) {

                $statisticPosition = DB::table('reports')
                    ->select('position_id', DB::raw('SUM(reports.time) as sumTime'))
                    ->where('project_id', $request->project_id)
                    ->join('projects', 'projects.id', '=', 'reports.project_id')
                    ->join('positions', 'positions.id', '=', 'reports.position_id')
                    ->groupBy('position_id')
                    ->get();

                $statisticMember = DB::table('reports')
                    ->select(DB::raw('SUM(reports.time) as sumTime'), 'working_type')
                    ->where('user_id', $request->user_id)
                    ->where('project_id', $request->project_id)
                    ->groupBy('working_type')
                    ->get();

                $positionArrayId = [];
                $timeArray = [];
                $positionArray = [];

                foreach ($statisticPosition as $value) {
                    $positionArrayId[] = $value->position_id;
                    $timeArray[] = $value->sumTime;
                }

                foreach ($positionArrayId as $value) {
                    foreach ($positions as $v) {
                        if ($value == $v->id) {
                            $positionArray[] = $v->name;
                        }
                    }
                }

                $typeArray = [];
                $timeArrayUser = [];

                foreach ($statisticMember as $value) {
                    $typeArray[] = $value->working_type;
                    $timeArrayUser[] = $value->sumTime;
                }

                return view('home', compact('projects',
                    'positionArray',
                    'timeArray',
                    'users',
                    'timeArrayUser',
                    'typeArray'));
            }
            return view('home', compact('projects', 'users'));
        } else {
            $projects = DB::table('project_has_user')
                ->select('project_id as id', 'projects.name as name')
                ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
                ->where('user_id', '=', $user_id)
                ->get();
            if (!empty($request->project_id)){
                $timeStart = $request->start;
                $timeEnd = $request->end;

                if (empty($request->start)) {
                    $timeStart = $startByMonth;
                }

                if (empty($request->end)) {
                    $timeEnd = date('Y-m-d');
                }

                $timeStart = date('Y-m-d', strtotime($timeStart));
                $timeEnd = date('Y-m-d', strtotime($timeEnd));
//            dd($timeStart);
                $timeByMonth = DB::table('reports')
                    ->select('working_type', DB::raw('SUM(time) as sumTime'))
                    ->where('working_time', '>=', $timeStart)
                    ->where('working_time', '<=', $timeEnd)
                    ->where('user_id', '=', $user_id)
                    ->groupBy('working_type')
                    ->get();
//dd($timeByMonth);
                $statisticUserProject = DB::table('reports')
                    ->select(DB::raw('SUM(reports.time) as sumTime'))
                    ->where('user_id', '=', $user_id)
                    ->where('project_id', '=', $request->project_id)
                    ->join('projects', 'projects.id', '=', 'reports.project_id')
                    ->get();

                $projectNameArray = DB::table('projects')
                    ->select('name')
                    ->where('id', '=', $request->project_id)
                    ->get();

                $totalTimeUser = [];

                foreach ($projectNameArray as $value) {
                    $projectName = $value;
                }
                foreach ($statisticUserProject as $value) {
                    $totalTimeUser[] = $value->sumTime;
                }

                $arrayTimeMonth = [];
                $arrayWorkingType = [];

                foreach ($timeByMonth as $value) {
                    $arrayTimeMonth[] = $value->sumTime;
                    $arrayWorkingType[] = $value->working_type;
                }
//                dd($arrayTimeMonth);
                return view('home', compact('projects',
                    'projectName',
                    'totalTimeUser',
                    'arrayTimeMonth',
                    'arrayWorkingType'));
            }
            return view('home',compact('projects'));

        }
    }
}
