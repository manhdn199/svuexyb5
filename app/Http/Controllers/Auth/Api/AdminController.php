<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\Memberlist;
use App\Models\Projects;
use App\Models\UserhasRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showUserRole()
    {
        $role = UserhasRole::with([
            'hasUser',
            'hasRole',
        ])
            ->get();
        foreach ($role as $value) {
            echo "<pre>";
            print_r($value->hasUser->name);
        }
    }

    public function createUserRole(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        $users = DB::table('user_has_role')
            ->where('user_id', $user_id)
            ->where('role_id', $role_id)
            ->first();
        if (empty($users)) {
            UserhasRole::create([
                'user_id' => $user_id,
                'role_id' => $role_id,
            ]);
        } else {
            return response()->json(['success' => 'Exist'], 200);
        }
        return response()->json(['success' => 'Created'], 200);

    }

    public function updateUserRole(Request $request, $id)
    {
        $project = UserhasRole::findOrFail($id);
        $input = $request->all();
        UserhasRole::where('id', $id)->update($input);
        return response()->json(['success' => 'Update Success'], 200);

    }

    public function deleteUserRole($id)
    {
        $project = UserhasRole::findOrFail($id);
        $project->delete();
        return "Success Delete";
    }

}


