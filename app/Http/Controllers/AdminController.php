<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
    return view('admin.dashboard');
    }

    public function modules()
    {
        return view('admin.modules.index');
    }

    public function teachers()
    {
    $teachers = User::whereHas('role', fn($q) => $q->where('role', 'teacher'))->get();
    return view('admin.teachers.index', compact('teachers'));
    }

    public function students()
    {
    $students = User::whereHas('role', fn($q) => $q->where('role', 'student'))->get();
    return view('admin.students.index', compact('students'));
    }

    public function oldStudents()
    {
    $oldStudents = User::whereHas('role', fn($q) => $q->where('role', 'old_student'))->with('completedModules')->get();
    return view('admin.old-students.index', compact('oldStudents'));
    }

}
