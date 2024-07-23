<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() 
    {
        return view('admin.login');
    }

    public function formLogin()
    {
        if(Auth::check())
        {
            return redirect()->route('home');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $login = $request->validate(
        [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($login)) 
        {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return redirect()->back()->with('login', 'Error, Email Dan Password Anda SALAH!!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Berhasil Logout');
    }
}
