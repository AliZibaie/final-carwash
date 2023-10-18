<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Diff\Exception;

class AuthController extends Controller
{
    public function login()
    {

    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(RegisterUserRequest $request)
    {
       try
       {
           $user =  User::create($request->validated());
           Auth::login($user, true);
           return redirect(status: 200)->route('dashboard');
       }
       catch (Exception $e)
       {
           return redirect(status: 500)->route('/');
       }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
