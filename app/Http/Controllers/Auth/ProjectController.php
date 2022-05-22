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
//show projects
    public function projects(Request $request)
    {
        $paginate = config('constants.paginate');

        $project = Projects::sortable()
            ->paginate($paginate);

        if (!empty($request->search) || !empty($request->name)) {
            $search = $request->search
                ? '%' . $request->search . '%'
                : '%' . $request->name . '%';

            $project = Projects::sortable()
                ->where('name', 'like', $search)
                ->paginate($paginate);

        } elseif (!empty($request->detail)) {
            $search = '%' . $request->detail . '%';

            $project = Projects::sortable()
                ->where('detail', 'like', $search)
                ->paginate($paginate);
        }
        return view('auth/project/projects', compact('project'));
    }
//view edit project
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

        $nameUser = DB::table('project_has_user')
            ->select('users.name as nameUser')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->where('project_has_user.project_id', '=', $id)
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

        return view('auth/project/edit', [
            'project' => $edit,
            'arrayMember' => $arrayMember,
            'nameUser' => $nameUser]);
    }
// edit project
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
        $edit_project = 'Success update project';

        return redirect()->route('projects',compact('edit_project'));
    }
//view add project
    public function viewAdd()
    {
        return view('auth/project/add');
    }
//add project
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
        $add_project = 'Success add project';

        return redirect()->route('projects',compact('add_project'));
    }
//delete project
    public function delete($id)
    {
        $project = Projects::findOrFail($id);
        $idProject = $project->id;
        $checkRole = DB::table('project_has_user')
            ->where('project_id', $idProject)
            ->first();

        if (empty($checkRole)) {
            $project->delete();
        } else {
            $error_delete_project =  'Some one has role';

            return \redirect()->route('projects',compact('error_delete_project'));
        }

        $delete_project = 'Success detele project';

        return \redirect()->route('projects',compact('delete_project'));

    }
}
