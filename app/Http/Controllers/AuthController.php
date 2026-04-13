<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard() {
        $user = Auth::user();

        return view('dashboard');

        abort(403);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();

            if($user->role == 'admin') {
                return redirect()->route('dashboard')->with('success', 'Login Admin Success');
            }

            if($user->role == 'operator') {
                return redirect()->route('dashboard')->with('success', 'Login Operator Success');
            }
        }

        return redirect()->back()->with('error', 'Email or Password Incorrect');
    }

    public function logout(Request $request) {
        Auth::logout();

        return redirect()->route('landing');
    }
}
