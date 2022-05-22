<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\MemberList;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->roleAdmin = config('constants.admin');
        $this->roleManage = config('constants.manager');
        $this->roleMember = config('constants.member');
        $this->reportByEmployee = config('constants.reportbyemployee');
        $this->errorReportEmployee = config('constants.errorReportEmployee');
    }
//show all roles
    public function roles(Request $request)
    {
        $paginate = config('constants.paginate');

        $roles = Role::sortable()
            ->paginate($paginate);

        if (!empty($request->search)) {
            $search = '%' . $request->search . '%';

            $roles = Role::sortable()
                ->where('name', 'like', $search)
                ->paginate($paginate);
        }

        return view('auth/roles/roles', compact('roles'));
    }
//view edit role
    public function viewEdit($id)
    {
        $edit = DB::table('roles')
            ->where('id', $id)
            ->first();

        $permissionInRole = RoleHasPermission::sortable()
            ->select('roles.name as nameRole',
                'permissions.name as namePer','role_id','permission_id')
            ->where('role_id','=',$edit->id)
            ->join('roles', 'roles.id', '=', 'role_has_permission.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_has_permission.permission_id')
            ->get();

        if ($edit->id == $this->roleAdmin || $edit->id == $this->roleManage || $edit->id == $this->roleMember)
        {
            return \redirect()->route('roles');
        }
        else
        {
            $permissions = Permission::all();

            return view('auth/roles/edit', [
                'roless' => $edit,
                'permissionInRole' => $permissionInRole,
                'permissions' => $permissions]);
        }

    }
// edit role
    public function edit(Request $request, $id)
    {
        $input = [];
        $input['name'] = $request->name;
        $permissions = $request->permissions;

        if (in_array($this->reportByEmployee,$permissions) && count($permissions) >= 2)
        {
            $errorSetPermission = $this->errorReportEmployee;

            return \redirect()->route('viewEditRole',compact('id','errorSetPermission'));
        }

        RoleHasPermission::where('role_id','=',$id)->delete();

        foreach ($permissions as $v)
        {
            DB::insert("INSERT INTO role_has_permission(role_id,permission_id)VALUES('$id','$v')");
        }

        DB::table('roles')
            ->where('id', $id)
            ->update($input);

        $edit_role = 'Success update role';
        return redirect()->route('roles',compact('edit_role'));
    }
// view add role
    public function viewAdd()
    {
        $permissions = Permission::all();

        return view('auth/roles/add',compact('permissions'));
    }
//add role
    public function add(Request $request)
    {
        $input = [];
        $input['name'] = $request->name;
        $permissions = $request->permissions;
        DB::table('roles')
            ->insert($input);

        $newRole_id = DB::table('roles')
            ->orderBy('id','desc')
            ->first();

        if (in_array($this->reportByEmployee,$permissions) && count($permissions) >= 2)
        {
            $errorSetPermission = $this->errorReportEmployee;

            return \redirect()->route('viewAddRole',compact('errorSetPermission'));
        }

        foreach ($permissions as $v)
        {
            DB::insert("INSERT INTO role_has_permission(role_id,permission_id)VALUES('$newRole_id->id','$v')");
        }
        $add_role = 'Success add role';

        return redirect()->route('roles',compact('add_role'));
    }
//delete role
    public function delete($id)
    {
        $paginate = config('constants.paginate');
        $role = Role::findOrFail($id);
        $idRole = $role->id;

        $checkRole = DB::table('user_has_role')
            ->where('role_id', $idRole)
            ->first();;

        if (empty($checkRole)) {
            $role->delete();
        } else {
            $errors =
                ['error' => 'Some one has role!'];

        }

        $roles = DB::table('roles')
            ->select("*")
            ->paginate($paginate);

        return view('auth/roles/roles', compact('roles', 'errors'));

    }

}
