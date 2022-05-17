<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReportRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Position;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $input = [];
        $input['password'] = Hash::make($request->password);
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['gender'] = $request->gender;
        $input['birthday'] = $request->birthday;
        $input['tel'] = $request->tel;
        $input['address'] = $request->address;

        DB::table('users')
            ->where('id', $id)
            ->update($input);

        return redirect()->route('home');
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('auth/profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showReports(Request $request)
    {
        $paginate = config('constants.paginate');

        $user = Auth::user();

        if (empty($request))
        {
            $reports = DB::table('reports')
                ->select('reports.detail',
                    'projects.name as projectName',
                    'reports.working_time',
                    'reports.working_type',
                    'reports.time',
                    'reports.status',
                    'reports.id',
                    'positions.name as position')
                ->where('reports.user_id', $user->id)
                ->join('projects', 'projects.id', '=', 'reports.project_id')
                ->join('positions', 'positions.id', '=', 'reports.position_id')
                ->paginate($paginate);
        }
        else
        {
            $timeStart = $request->start;
            $timeEnd = $request->end;

            if (empty($request->start)) {
                $timeStart = date('01-m-Y');
            }
            if(empty($request->end)) {
                $timeEnd = date('d-m-Y');
            }
//            dd($timeEnd);

            $dateStart = date('Y-m-d',strtotime($timeStart));
            $dateEnd = date('Y-m-d',strtotime($timeEnd));

            $reports = DB::table('reports')
                ->select('reports.detail',
                    'projects.name as projectName',
                    'reports.working_time',
                    'reports.working_type',
                    'reports.time',
                    'reports.status',
                    'reports.id',
                    'positions.name as position')
                ->where('reports.user_id', $user->id)
                ->where('reports.working_time','<=',$dateEnd)
                ->where('reports.working_time','>=',$dateStart)
                ->join('projects', 'projects.id', '=', 'reports.project_id')
                ->join('positions', 'positions.id', '=', 'reports.position_id')
                ->paginate($paginate);
//            ->toSql();
//            dd($timeStart);
        }


        return view('auth/reports/reports', ['reports' => $reports]);
    }

    public function showEditReport($id)
    {
        $report = DB::table('reports')
            ->where('id', $id)
            ->first();

        $user = Auth::user();

        $project = DB::table('project_has_user')
            ->select('projects.id as idProject', 'projects.name as projectName')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->where('user_id', $user->id)
            ->get();

        $positions = DB::table('positions')
            ->select('name', 'id')
            ->get();

        return view('auth/reports/edit', compact('report', 'project', 'positions'));
    }

    public function editReport(Request $request, $id)
    {
        $positions = DB::table('positions')
            ->select('id')
            ->where('name', $request->working_type)
            ->first();

        $input = [];
        $input['detail'] = $request->detail;
        $input['working_time'] = $request->working_time;
        $input['working_type'] = $request->working_type;
        $input['time'] = $request->time;
        $input['position_id'] = $positions->id;

        DB::table('reports')
            ->where('id', $id)
            ->update($input);

        return redirect()->route('reports');
    }

    public function showFormReport()
    {
        $user = Auth::user();

        $project = DB::table('project_has_user')
            ->select('projects.id as idProject', 'projects.name as projectName')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->where('user_id', $user->id)
            ->get();

        $positions = DB::table('positions')
            ->select('name', 'id')
            ->get();

        return view('auth/reports', compact('user', 'project', 'positions'));
    }

    public function addReport(AddReportRequest $request)
    {
        $user = Auth::user();

        $project = DB::table('project_has_user')
            ->select('projects.id as idProject', 'projects.name as projectName')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->where('user_id', $user->id)
            ->get();

        $positions = DB::table('positions')
            ->select('name', 'id')
            ->get();

        $position = DB::table('positions')
            ->select('id')
            ->where('name', $request->working_type)
            ->get();

        $checkTime = DB::table('projects')
            ->where('id', $request->project)
            ->where('start', '<', $request->working_time)
            ->where('end', '>', $request->working_time)
            ->first();

        $status = config('constants.status');

        $input = [];
        $input['user_id'] = $request->user_id;
        $input['detail'] = $request->detail;
        $input['working_time'] = $request->working_time;
        $input['working_type'] = $request->working_type;
        $input['time'] = $request->time;
        $input['project_id'] = $request->project;
        $input['position_id'] = $request->position_id;
        $input['status'] = $status;

        if (empty($checkTime)) {
            $error = 'Time is out time project';

            return view('auth/reports', compact('user', 'project', 'error', 'positions'));

        } else {
            Report::create($input);

            return redirect()->route('reportsEmployee');
        }

    }

    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('reports');
    }
}
