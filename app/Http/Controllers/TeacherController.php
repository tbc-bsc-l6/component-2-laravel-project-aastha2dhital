<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Teacher dashboard
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    // View modules assigned to teacher
    public function modules()
    {
        return view('teacher.modules');
    }

    // View students in a module
    public function students($module)
    {
        return view('teacher.students');
    }
}
