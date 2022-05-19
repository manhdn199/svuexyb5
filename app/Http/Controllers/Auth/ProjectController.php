<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UserRequest;
use App\Models\MemberList;
use App\Models\Projects;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    public function projects(Request $request)
    {
        $paginate = config('constants.paginate');

        $project = Projects::sortable()
            ->paginate($paginate);

        if (!empty($request->search)) {
            $search = '%' . $request->search . '%';

            $project = Projects::sortable()
                ->where('name', 'like', $search)
                ->paginate($paginate);
        }

        return view('auth/project/projects', compact('project'));
    }

    public function viewEdit($id)
    {
        $edit = DB::table('projects')
            ->where('id', $id)
            ->first();

        $member = DB::table('reports')
            ->select('users.name as nameUser', 'positions.name as namePosition')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->join('positions', 'positions.id', '=', 'reports.position_id')
            ->where('reports.project_id', '=', $id)
            ->get();

        $arrayMember = [];

        foreach ($member as $value) {
            if (array_key_exists($value->nameUser, $arrayMember)) {
                if (!in_array($value->namePosition, $arrayMember)) {
                    $arrayMember[$value->nameUser][] = $value->namePosition;
                }
            } else {
                $arrayMember[$value->nameUser] = [$value->namePosition];
            }

        }

        return view('auth/project/edit', ['project' => $edit,
            'arrayMember' => $arrayMember]);
    }

    public function edit(ProjectRequest $request, $id)
    {
        $input = [];
        $input['name'] = $request->name;
        $input['detail'] = $request->detail;
        $input['duration'] = $request->duration;
        $input['revenue'] = $request->revenue;
        $input['start'] = $request->start;
        $input['end'] = $request->end;

        DB::table('projects')
            ->where('id', $id)
            ->update($input);

        return redirect()->route('projects');
    }

    public function viewAdd()
    {
        return view('auth/project/add');
    }

    public function add(ProjectRequest $request)
    {
        $input = [];
        $input['name'] = $request->name;
        $input['detail'] = $request->detail;
        $input['duration'] = $request->duration;
        $input['revenue'] = $request->revenue;
        $input['start'] = $request->start;
        $input['end'] = $request->end;

        Projects::create($input);

        return redirect()->route('projects');
    }

    public function delete($id)
    {
        $project = Projects::findOrFail($id);
        $idProject = $project->id;
        $checkRole = DB::table('user_has_role')
            ->where('project_id', $idProject)
            ->first();;

        if (empty($checkRole)) {
            $project->delete();
        } else {
            return Redirect::back()->withErrors([
                'error' => 'Some one has role!'
            ]);
        }

        return view('/projects');
    }
}
