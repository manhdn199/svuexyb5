<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function projects()
    {
        $project = DB::table('projects')
            ->select("*")
            ->get();

        return view('auth/project/projects',compact('project'));
    }

    public function viewEdit($id)
    {
        $edit = DB::table('projects')->where('id',$id)->first();

        return view('auth/project/edit',['project' => $edit]);
    }

    public function edit(Request $request, $id)
    {
//        $input = $request->all();
        $input = [];
        $input['name'] = $request->name;
        $input['detail'] = $request->detail;
        $input['duration'] = $request->duration;
        $input['revenue'] = $request->revenue;

        DB::table('projects')
            ->where('id', $id)
            ->update($input);

        return redirect()->route('projects');
    }

    public function viewAdd()
    {
        return view('auth/roles/add');
    }
    public function add(UserRequest $request)
    {
        $input = [];
        $input['name'] = $request->name;
        $input['detail'] = $request->detail;
        $input['duration'] = $request->duration;
        $input['revenue'] = $request->revenue;

        Projects::create($input);

        return redirect()->route('projects');
    }

    public function delete($id)
    {
        $project = Projects::findOrFail($id);
        $idProject = $project->id;
        $checkRole = DB::table('user_has_role')->where('project_id',$idProject)->first();;

        if (empty($checkRole))
        {
            $project->delete();
        }
        else
        {
            return Redirect::back()->withErrors([
                'error' => 'Some one has role!'
            ]);
        }

        return view('/projects');
    }
}
