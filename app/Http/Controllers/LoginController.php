<?php

namespace App\Http\Controllers;
use App\Helpers\Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $result = $this->login($request);
    }

}
