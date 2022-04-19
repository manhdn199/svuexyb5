<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\AddMemberList;
use App\Models\Memberlist;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function viewProject()
    {
        return view('projects');
    }

    public function showRequestAddUser(Request $request, $id = 1)
    {
        $projectId = Projects::findOrFail($id);
        $project_id = $projectId->id;
        $position_id = $request->chosePosition;
        foreach ($request->choseUser as $value) {
            $users = DB::table('memberlist')
                ->where('user_id', $value)
                ->where('position_id', $position_id)
                ->where('project_id', $project_id)
                ->first();

            if (empty($users)) {
                Memberlist::create([
                    'user_id' => $value,
                    'position_id' => $position_id,
                    'project_id' => $project_id
                ]);
            } else {
                return response()->json(['success' => 'Exist'], 200);
            }
        }
        return response()->json(['success' => 'Created'], 200);
    }

    public function showProjects()
    {
        $project = Memberlist::with([
            'hasUser',
            'hasPosition',
            'hasProject'])
            ->get();
        foreach ($project as $value) {
            echo "<pre>";
            print_r($value->hasUser->name);
        }
    }

    public function createProject(ProjectRequest $request)
    {
        $input = $request->all();
        Projects::create
        ([
            'name' => $request->name,
            'detail' => $request->detail,
            'duration' => $request->duration,
            'revenue' => $request->revenue,
        ]);
        return response()->json([
            'message' => 'Created'
        ], 200);
    }

    public function updateProject(Request $request, $id)
    {
        $project = Projects::findOrFail($id);
        $input = $request->all();
        Projects::where('id', $id)->update($input);
        return response()->json(['success' => 'Update Success'], 200);

    }
    public function updateUserProject(Request $request, $id)
    {
        //
    }
    public function deleteProject($id)
    {
        $project = Projects::findOrFail($id);
        $project_id = $project->id;
        $users = DB::table('memberlist')
            ->where('project_id', $project_id)
            ->delete();
        $project->delete();
        return "Success Delete";
    }
}


