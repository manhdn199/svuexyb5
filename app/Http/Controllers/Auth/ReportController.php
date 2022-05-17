<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = config('constants.paginate');

        $reports = DB::table('reports')
            ->select('reports.detail',
                'projects.name as projectName',
                'reports.working_time',
                'reports.working_type',
                'reports.time',
                'reports.status',
                'reports.id',
                'users.name as userName',
                'reports.project_id',
                'positions.name as position')
            ->join('projects', 'projects.id', '=', 'reports.project_id')
            ->join('positions', 'positions.id', '=', 'reports.position_id')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->paginate($paginate);


        $project = DB::table('projects')
            ->select('name')
            ->get()
            ->toArray();

        return view('auth/reports/admin', ['report' => $reports]);
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
    public function edit($id)
    {
        $accept = config('constants.accept');

        $report = Report::findOrFail($id);
        $report->status = $accept;

        $report->save();

        return redirect()->route('reports');
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
}
