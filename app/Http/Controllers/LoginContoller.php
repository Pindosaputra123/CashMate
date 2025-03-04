<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return response()->view('login.index');
    }

    public function login(Request $request)
    {
        Validations::loginValidate($request);
        
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();
        
        if(Hash::check($credentials['password'], $user->password)){
            Auth::loginUsingId($user->id);

            return Response::success();
        } else {
            return Response::error('Username atau password salah');
        }
    }
}
