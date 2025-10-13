<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthAdminController extends Controller
{
    public function index() {
        return view('admin.auth');
    }

    public function authDisplay(){
        $user = Auth::user();
        return view('admin.sidebar', compact('user'));
    }

    public function signin(Request $request) {
        // Validate only email and password from request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
    
        // Attempt login with extra condition for role = admin
        if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');

        }

        if (Auth::attempt(array_merge($credentials, ['role' => 'teacher']))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are not authorized.',
        ])->onlyInput('email');
    }
    

    public function showRegister(){
        return view('admin.register_admin');
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'age' => ['required', 'integer', 'min:1'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,teacher,student'], 
        ]);
    
        $user = User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'age' => $validated['age'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => 'active', // default active on registration
        ]);
     
        // Change route name as per your routes file
        return redirect()->route('admin.dashboard'); 
    }
    
    
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login'); 
    }



}
