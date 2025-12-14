<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
     // Admin dashboard
    public function dashboard()
    {
       return view('admin.dashboard');
    }

    // List all teachers
    public function teachers()
{
    $teachers = User::whereHas('role', function ($query) {
        $query->where('name', 'teacher');
    })->get();

    return view('admin.teachers', compact('teachers'));
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
