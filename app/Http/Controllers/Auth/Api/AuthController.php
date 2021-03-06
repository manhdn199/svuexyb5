<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\UserhasRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {

        $user = User::where(
            'email', $request->email
        )->first();
        $role = $user->userHasRole->role_id;

        if (!$user)
        {

            return response()->json([
                'message' => "User dont exist!"
            ],404);
        }

        if (!Hash::check($request->password, $user->password ,[]))
        {

            return response()->json([
                'message' => "Wrong password!"
            ],404);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login!',
            'access_token' => $token,
            'type_token' => 'Bearer',
            'role_id' => $user->userHasRole->role_id,
        ],200);
//        return view('content/home');

    }

    public function register(Request $request)
    {
        $messages = [
            'email.email' => 'Error email!',
            'email.required' => 'Required email',
            'password.required' => 'Required password'
        ];

        $validator = Validator::make($request->all(),
            [
                'email'=>'email| required'
            ]
            , $messages);

        if ($validator->fails())
        {
            return response()->json([
                'message' => $validator->errors()
            ],404);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Created'
        ],200);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Log out!'
        ],200);
    }
}

