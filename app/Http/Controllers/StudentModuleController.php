<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StudentModuleController extends Controller
{

    public function index() {
            $modules = Module::all();

        return view('pages.modules', compact('modules'));

    }

}