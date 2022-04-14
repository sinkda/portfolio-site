<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    // login form
    public function index()
    {
        return view('login');
    }

    // submit login
    public function login(LoginRequest $request)
    {
        if(auth()->attempt($request->only(['email', 'password']), $request->boolean('rememberme')))
        {
            $request->session()->regenerate();

            return redirect()->intended();
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email', 'rememberme');
    }

    // logout
    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login.index');
    }
}
