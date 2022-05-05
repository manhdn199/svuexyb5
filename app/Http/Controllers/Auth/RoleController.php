<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\MemberList;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{

    public function roles()
    {
        $role = DB::table('roles')
            ->select("*")
            ->get();

        return view('auth/roles/roles',compact('role'));
    }

    public function viewEdit($id)
    {
        $edit = DB::table('roles')
            ->where('id',$id)
            ->first();

        return view('auth/roles/edit',['role' => $edit]);
    }

    public function edit(Request $request, $id)
    {
//        $input = $request->all();
        $input = [];
        $input['name'] = $request->name;

        DB::table('roles')
            ->where('id', $id)
            ->update($input);

        return redirect()->route('roles');
    }

    public function viewAdd()
    {
        return view('auth/roles/add');
    }
    public function add(UserRequest $request)
    {
        $input = $request->all();

        Role::create($input);

        return redirect()->route('roles');
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $idRole = $role->id;

        $checkRole = DB::table('user_has_role')
            ->where('role_id',$idRole)
            ->first();;

        if (empty($checkRole))
        {
            $role->delete();
        }
        else
        {
            return Redirect::back()->withErrors([
                'error' => 'Some one has role!'
            ]);
        }

        return view('/roles');
    }
}
