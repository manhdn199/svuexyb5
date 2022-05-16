<?php

namespace App\Http\Controllers\Auth;

use App\Charts\StatisticPositionChart;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function StatisticProject(Request $request)
    {
        $projects = DB::table('projects')
            ->get();

        $users = DB::table('users')
            ->get();

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

        $positionArray = [];
        $timeArray = [];

        foreach ($statisticPosition as $value) {
            $positionArray[] = $value->position_id;
            $timeArray[] = $value->sumTime;
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
}
