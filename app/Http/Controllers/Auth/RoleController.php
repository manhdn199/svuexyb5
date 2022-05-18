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

    public function roles(Request $request)
    {
        $paginate = config('constants.paginate');

        $role = DB::table('roles')
            ->select("*")
            ->paginate($paginate);

        if (!empty($request->search)) {
            $search = '%' . $request->search . '%';

            $role = DB::table('roles')
                ->select("*")
                ->where('name', 'like', $search)
                ->paginate($paginate);
        }

        return view('auth/roles/roles', compact('role'));
    }

    public function viewEdit($id)
    {
        $edit = DB::table('roles')
            ->where('id', $id)
            ->first();

        return view('auth/roles/edit', ['role' => $edit]);
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

    public function add(Request $request)
    {
        $input = $request->name;
        if (!empty($input)) {
            Role::create($input);
            return redirect()->route('roles');
        }

        return redirect()->route('roles');

    }

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

        $role = DB::table('roles')
            ->select("*")
            ->paginate($paginate);

        return view('auth/roles/roles', compact('role', 'errors'));

    }
}
