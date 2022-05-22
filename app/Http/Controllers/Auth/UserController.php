<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\MemberList;
use App\Models\ProjectHasUser;
use App\Models\Projects;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use App\Models\UserhasRole;
use Database\Seeders\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Kyslik\ColumnSortable\Sortable;


class UserController extends Controller
{
//show all users
    public function users(Request $request)
    {

        $paginate = config('constants.paginate');

        $user = User::sortable()->paginate($paginate);

        if (!empty($request->search) || !empty($request->name)) {
            $search = $request->search
                ? '%' . $request->search . '%'
                : '%' . $request->name . '%';

            $user = User::sortable()->where('name', 'like', $search)
                ->paginate($paginate);

        } elseif (!empty($request->email)) {
            $search = '%' . $request->email . '%';

            $user = User::sortable()->where('email', 'like', $search)
                ->paginate($paginate);

        } elseif (!empty($request->tel)) {
            $search = '%' . $request->tel . '%';

            $user = User::sortable()->where('tel', 'like', $search)
                ->paginate($paginate);
        }

        return view('auth/users', compact('user'));
    }
// view edit user
    public function viewEdit($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        return view('auth/edit', ['user' => $user]);
    }
// edit user
    public function edit(Request $request, $id)
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
            ->where('id', $id)
            ->update($input);

        $edit_user = 'Success edit user';

        return redirect()->route('users',compact('edit_user'));
    }
//view add user
    public function viewAdd()
    {
        return view('auth/add');
    }
//add user
    public function add(UserRequest $request)
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

        $add_user = 'Success add user';

        return redirect()->route('users',compact('add_user'));
    }
// delete user
    public function delete($id)
    {
        $paginate = config('constants.paginate');
        $user = User::findOrFail($id);
        $idUser = $user->id;

        $projectMem = DB::table('memberList')
            ->where('user_id', $idUser)
            ->first();;

        if (empty($projectMem)) {
            $user->delete();
        } else {
            $errors =
                ['error' => 'User is in project!'];
        }

        $user = DB::table('users')
            ->select("*")
            ->paginate($paginate);

        return view('auth/users', compact('errors', 'user'));
    }
// view add user has role
    public function viewAddRole()
    {
        $user = DB::table('users')
            ->select('id', 'name')
            ->get();

        $roles = DB::table('roles')
            ->select('id', 'name')
            ->get();

        return view('auth/roles/userAddRole', compact('user', 'roles'));
    }

    public function addRole(Request $request)
    {
        $paginate = config('constants.paginate');
        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $user = DB::table('users')
            ->select('id', 'name')
            ->get();

        $roles = DB::table('roles')
            ->select('id', 'name')
            ->get();

        $userHasRole = UserhasRole::sortable()
            ->paginate($paginate);

        $checkRole = DB::table('user_has_role')
            ->where('user_id', $user_id)
            ->Where('role_id', $role_id)
            ->first();

        if (empty($checkRole)) {
            UserhasRole::create([
                'user_id' => $user_id,
                'role_id' => $role_id,
            ]);
        } else {
            $error = 'User has added a role!';

            return view('auth/roles/userAddRole', compact('user', 'roles', 'error'));

        }

        $add_role_user = 'Success user add role';

        return \redirect()->route('userHasRole', compact('userHasRole','add_role_user'));

    }
//view list user has role
    public function userHasRole(Request $request)
    {
        $paginate = config('constants.paginate');

        $userHasRole = UserhasRole::sortable()
            ->select('users.name as userName',
                'roles.name as roleName',
                'user_has_role.id')
            ->join('users', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->paginate($paginate);

        if (!empty($request->search) || !empty($request->user)) {
            $search = $request->search
                ? '%' . $request->search . '%'
                : '%' . $request->user . '%';

            $userHasRole = UserhasRole::sortable()
                ->select('users.name as userName',
                    'roles.name as roleName',
                    'user_has_role.id')
                ->where('users.name', 'like', $search)
                ->join('users', 'users.id', '=', 'user_has_role.user_id')
                ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                ->paginate($paginate);
        } elseif (!empty($request->role)) {
            $search = '%' . $request->role . '%';

            $userHasRole = UserhasRole::sortable()
                ->select('users.name as userName',
                    'roles.name as roleName',
                    'user_has_role.id')
                ->where('roles.name', 'like', $search)
                ->join('users', 'users.id', '=', 'user_has_role.user_id')
                ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                ->paginate($paginate);
        }


        return view('auth/userHasRole', compact('userHasRole'));
    }
// view edit user has role
    public function viewEditRole($id)
    {
        $useHasRole = UserhasRole::findOrFail($id);

        $hasRole = UserhasRole::sortable()
            ->select('user_has_role.id',
                'users.name as nameUser',
                'roles.name as nameRole',
                'user_id',
                'role_id')
            ->where('user_id', '=', $useHasRole->user_id)
            ->where('role_id', '=', $useHasRole->role_id)
            ->join('users', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->first();

        $roles = Role::all();

        return view('auth/roles/editHasRole', compact('hasRole', 'roles'));
    }
// edit user has role
    public function editHasRole(Request $request, $id)
    {
        $paginate = config('constants.paginate');

        $input = [];
        $input['user_id'] = $request->user_id;
        $input['role_id'] = $request->role_id;

        DB::table('user_has_role')
            ->where('id', $id)
            ->update($input);

        $userHasRole = UserhasRole::sortable()
            ->select('users.name as userName',
                'roles.name as roleName',
                'user_has_role.id')
            ->join('users', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->paginate($paginate);

        $edit_role_user = 'Success update user has role';
        return \redirect()->route('userHasRole',compact('edit_role_user'));
    }
// delete user has role
    public function deleteHasRole($id)
    {
        $userhasRole = UserhasRole::findOrFail($id);

        $userhasRole->delete();

        $paginate = config('constants.paginate');

        $userHasRole = UserhasRole::sortable()
            ->select('users.name as userName',
                'roles.name as roleName',
                'user_has_role.id')
            ->join('users', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->paginate($paginate);

        $delete_role_user = 'Success delete user has role';

        return view('auth/userHasRole', compact('userHasRole','delete_role_user'));


    }
// view list user has project
    public function userHasProject()
    {
        $paginate = config('constants.paginate');

        $userHasProject = DB::table('project_has_user')
            ->select('users.name as userName',
                'projects.name as projectName',
                'project_has_user.id',
                'user_id',
                'project_id')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->paginate($paginate);

        if (!empty($request->search) || !empty($request->user)) {
            $search = $request->search
                ? '%' . $request->search . '%'
                : '%' . $request->user . '%';

            $userHasProject = DB::table('project_has_user')
                ->select('users.name as userName',
                    'projects.name as projectName',
                    'project_has_user.id',
                    'user_id',
                    'project_id')
                ->where('users.name', 'like', $search)
                ->join('users', 'users.id', '=', 'project_has_user.user_id')
                ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
                ->paginate($paginate);
        } elseif (!empty($request->project)) {
            $search = '%' . $request->project . '%';

            $userHasProject = DB::table('project_has_user')
                ->select('users.name as userName',
                    'projects.name as projectName',
                    'project_has_user.id',
                    'user_id',
                    'project_id')
                ->where('projects.name', 'like', $search)
                ->join('users', 'users.id', '=', 'project_has_user.user_id')
                ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
                ->paginate($paginate);
        }

        return view('auth/userHasProject', compact('userHasProject'));
    }

    public function viewEditHasProject($id)
    {
        $useHasProject = ProjectHasUser::findOrFail($id);

        $hasProject = DB::table('project_has_user')
            ->select('project_has_user.id',
                'users.name as nameUser',
                'projects.name as nameProject',
                'user_id',
                'project_id')
            ->where('user_id', '=', $useHasProject->user_id)
            ->where('project_id', '=', $useHasProject->project_id)
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->first();

        $projects = DB::table('projects')
            ->select('*')
            ->get();

        return view('auth/project/editHasProject', compact('hasProject', 'projects'));
    }

    public function editHasProject(Request $request, $id)
    {
        $paginate = config('constants.paginate');

        $input = [];
        $input['user_id'] = $request->user_id;
        $input['project_id'] = $request->project_id;

        DB::table('project_has_user')
            ->where('id', $id)
            ->update($input);

        $userHasProject = DB::table('project_has_user')
            ->select('users.name as userName', 'projects.name as projectName', 'project_has_user.id')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->paginate($paginate);

        $edit_user_has_project = ' Success update user has project';

        return \redirect()->route('userHasProject',compact('edit_user_has_project'));
    }

    public function groupProject($id)
    {
        $userHasProject = DB::table('reports')
            ->select('users.name as userName', 'projects.name as projectName', 'position_id')
            ->where('project_id', $id)
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->join('projects', 'projects.id', '=', 'reports.project_id')
            ->get();

        return view('auth/userHasProject', compact('userHasProject'));

    }

    public function viewAddUserHasProject()
    {
        $user = DB::table('users')
            ->select('id', 'name')
            ->get();

        $project = DB::table('projects')
            ->select('id', 'name')
            ->get();

        $user->toArray();
        $project->toArray();

        return view('auth/project/userHasProject', compact('user', 'project'));
    }

    public function addProject(Request $request)
    {
        $paginate = config('constants.paginate');
        $user_id = $request->user_id;
        $project_id = $request->project_id;
        $userHasProject = DB::table('project_has_user')
            ->select('users.name as userName',
                'projects.name as projectName',
                'project_has_user.id',
                'user_id',
                'project_id')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->paginate($paginate);

        $user = DB::table('users')
            ->select('id', 'name')
            ->get();

        $project = DB::table('projects')
            ->select('id', 'name')
            ->get();

        $checkProject = DB::table('project_has_user')
            ->where('user_id', $user_id)
            ->Where('project_id', $project_id)
            ->first();

        if (empty($checkProject)) {
            ProjectHasUser::create([
                'user_id' => $user_id,
                'project_id' => $project_id,
            ]);
        } else {
            $error = 'User has added a Project!';

            return view('auth/project/userHasProject', compact('user', 'project', 'error'));

        }

        $add_user_has_project = 'Success add user has project';

        return view('auth/userHasProject', compact('userHasProject','add_user_has_project'));
    }

    public function deleteHasProject($id)
    {
        $userHasProject = ProjectHasUser::findOrFail($id);

        $userHasProject->delete();

        $paginate = config('constants.paginate');

        $userHasProject = DB::table('project_has_user')
            ->select('users.name as userName',
                'projects.name as projectName',
                'project_has_user.id',
                'user_id',
                'project_id')
            ->join('users', 'users.id', '=', 'project_has_user.user_id')
            ->join('projects', 'projects.id', '=', 'project_has_user.project_id')
            ->paginate($paginate);

        $delete_user_project = 'Success delete';
        return \redirect()->route('userHasProject', compact('userHasProject','delete_user_project'));
    }

}
