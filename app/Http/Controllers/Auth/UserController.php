<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\MemberList;
use App\Models\ProjectHasUser;
use App\Models\Projects;
use App\Models\User;
use App\Models\UserhasRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function users()
    {
        $user = DB::table('users')
            ->select("*")
            ->get();

        return view('auth/users',compact('user'));
    }

    public function viewEdit($id)
    {
        $edit = DB::table('users')
            ->where('id',$id)
            ->first();

        return view('auth/edit',['user' => $edit]);
    }

    public function edit(Request $request, $id)
    {
//        $input = $request->all();
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

        return redirect()->route('users');
    }

    public function viewAdd()
    {
        return view('auth/add');
    }
    public function add(Request $request)
    {
        $input = [];
        $input['password'] = Hash::make($request->password);
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['gender'] = $request->gender;
        $input['birthday'] = $request->birthday;
        $input['tel'] = $request->tel;
        $input['address'] = $request->address;

        DB::table('users')
            ->insert($input);

        return redirect()->route('users');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $idUser = $user->id;
        $projectMem = DB::table('memberList')
            ->where('user_id',$idUser)
            ->first();;

        if (empty($projectMem))
        {
            $user->delete();

        }
        else
        {
            return Redirect::back()->withErrors([
                'error' => 'User is in project!'
            ]);
        }

        return view('/users');
    }

    public function viewAddRole()
    {
        $user = DB::table('users')
            ->select('id','name')
            ->get();

        $role = DB::table('roles')
            ->select('id','name')
            ->get();

        $user ->toArray();
        $role->toArray();

        return view('auth/roles/userAddRole',compact('user','role'));
    }

    public function addRole(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $userHasRole = DB::table('user_has_role')
            ->select('*')
            ->get();

        $users = DB::table('user_has_role')
            ->where('user_id', $user_id)
            ->orWhere('role_id', $role_id)
            ->first();

        if (empty($users)) {
            UserhasRole::create([
                'user_id' => $user_id,
                'role_id' => $role_id,
            ]);
        } else {
            return response()->json([
                'success' => 'Exist'
            ], 200);
        }

        return view('auth/userHasRole',compact('userHasRole'));

    }

    public function userHasRole()
    {
        $userHasRole = DB::table('user_has_role')
            ->select('users.name as userName','roles.name as roleName')
            ->join('users','users.id','=','user_has_role.user_id')
            ->join('roles','roles.id','=','user_has_role.role_id')
            ->get();

        return view('auth/userHasRole',compact('userHasRole'));
    }

    public function userHasProject()
    {
        $userHasProject = DB::table('project_has_user')
            ->select('users.name as userName','projects.name as projectName')
            ->join('users','users.id','=','project_has_user.user_id')
            ->join('projects','projects.id','=','project_has_user.project_id')
            ->get();

        return view('auth/userHasProject',compact('userHasProject'));
    }

    public function groupProject($id)
    {
        $userHasProject = DB::table('project_has_user')
            ->select('users.name as userName','projects.name as projectName')
            ->where('project_id',$id)
            ->join('users','users.id','=','project_has_user.user_id')
            ->join('projects','projects.id','=','project_has_user.project_id')
            ->get();

        return view('auth/userHasProject',compact('userHasProject'));

    }

    public function viewAddUserHasProject()
    {
        $user = DB::table('users')
            ->select('id','name')
            ->get();

        $project = DB::table('projects')
            ->select('id','name')
            ->get();

        $user->toArray();
        $project->toArray();

        return view('auth/project/userHasProject',compact('user','project'));
    }

    public function addProject(Request $request)
    {
        $user_id = $request->user_id;
        $project_id = $request->project_id;

        $userHasProject = DB::table('project_has_user')
            ->select('*')
            ->get();

        $users = DB::table('project_has_user')
            ->where('user_id', $user_id)
            ->Where('project_id', $project_id)
            ->first();

        if (empty($users)) {
            ProjectHasUser::create([
                'user_id' => $user_id,
                'project_id' => $project_id,
            ]);
        } else {

            return response()->json([
                'success' => 'Exist'
            ], 200);
        }

        return view('auth/userHasProject',compact('userHasProject'));

    }

}
