<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index() {
        $users = User::where('role', 'student')->get();
        $students = User::where('role', 'student')->count();
        $teachers = User::where('role', 'teacher')->count();
        return view('admin.admin', compact('users', 'students', 'teachers'));
    }
    
}
