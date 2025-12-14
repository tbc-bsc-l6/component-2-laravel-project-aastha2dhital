<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
     // Admin dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // List all teachers
    public function teachers()
    {
        return view('admin.teachers');
    }

    // List all modules
    public function modules()
    {
        return view('admin.modules');
    }

    // Form: assign a teacher to module
    public function assignTeacherForm($moduleId)
    {
        return view('admin.assign-teacher', ['moduleId' => $moduleId]);
    }

    // Submit: assign teacher
    public function assignTeacher(Request $request, $moduleId)
    {
        // logic soon
    }

    // Toggle module availability
    public function toggleAvailability($moduleId)
    {
        // logic soon
    }
}
