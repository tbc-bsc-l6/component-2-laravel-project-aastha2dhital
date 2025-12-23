<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        $modules = $student->modules; // enrolled modules

        return view('student.modules.index', compact('modules'));
    }
}
