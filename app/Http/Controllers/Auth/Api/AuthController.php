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
    public function getLogin()
    {
        return view('auth/login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where(
            'email', $request->email
        )->first();

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
        dd(auth('sanctum')->user());
        return view('content.home',compact('user'));
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

