<?php

namespace App\Http\Controllers\Auth;

use App\Charts\StatisticPositionChart;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function StatisticProject(Request $request)
    {
        $roleAdmin = config('constants.admin');
        $roleManage = config('constants.manage');
        $roleMember = config('constants.member');
        $user_id = Auth::user()->id;
        $user = Auth::user();
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

            if (empty($request->start)) {
                $timeStart = date('01-m-Y');
                $timeEnd = date('d-m-Y');
            } else {
                $timeStart = $request->start;
                $timeEnd = $request->end;
            }

            if (!empty($request->end)) {
                $timeByMonth = DB::table('reports')
                    ->select('working_type', DB::raw('SUM(time) as sumTime'))
                    ->where('working_time', '<=', $timeStart)
                    ->where('working_time', '>=', $timeEnd)
                    ->where('user_id', '=', $user_id)
                    ->groupBy('working_type')
                    ->get();

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

            return view('home', compact('projects'));
        }
    }
}
