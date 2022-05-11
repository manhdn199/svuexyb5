<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    public function editProfile(Request $request)
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

    public function showReports()
    {
        $user = Auth::user();

        $reports = DB::table('reports')
            ->select('*', 'projects.name as projectName')
            ->where('user_id', $user->id)
            ->join('projects', 'projects.id', '=', 'reports.project_id')
            ->get();

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

    public function addReport(Request $request)
    {
        $position = DB::table('positions')
            ->select('id')
            ->where('name', $request->working_type)
            ->get();

        foreach ($position as $value) {
            $position_id = $value->id;
        }

        $input = [];
        $input['user_id'] = $request->user_id;
        $input['detail'] = $request->detail;
        $input['working_time'] = $request->working_time;
        $input['working_type'] = $request->working_type;
        $input['time'] = $request->time;
        $input['project_id'] = $request->project;
        $input['position_id'] = $position_id;
        $input['status'] = 'waiting';

        Report::create($input);

    }

    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('reports');
    }
}
