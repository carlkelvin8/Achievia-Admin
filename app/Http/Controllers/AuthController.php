<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showSignup() {

        return view('auth.register');

    }
    public function showSignin() {

        return view('auth.signin');

    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'age' => ['required', 'integer', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::create([
            'first_name' => $validatedData['fname'],
            'last_name' => $validatedData['lname'],
            'middle_name' => $validatedData['mname'],
            'email' => $validatedData['email'],
            'age' => $validatedData['age'],
            'password' => $validatedData['password'],
            'role' => 'student'
        ]);

        return redirect()->route('signin')->with('success', 'Sign Up Successfully');
        
    }

    public function signin(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
}
