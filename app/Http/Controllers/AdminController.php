<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    // Show create teacher page 
    public function createTeacher()
    {
          return view('admin.create-teacher');
    }

    // Store new teacher
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $teacherRole = UserRole::where('name', 'teacher')->first();

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'user_role_id' => $teacherRole->id,
        ]);

        return redirect('/admin/teachers');
    }
    
    // Delete teacher
    public function deleteTeacher($id)
    {
    $teacher = User::findOrFail($id);
    $teacher->delete();

    return redirect('/admin/teachers');
    }

    // List all modules
    public function modules()
    {
        $modules = Module::all();
        return view('admin.modules', compact('modules'));
    }

    // Show create module page
    public function createModule()
    {
    return view('admin.create-module');
    }

    // Store new model
    public function storeModule(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Module::create([
        'name' => $request->name,
    ]);

    return redirect('/admin/modules');
    }

    // Show assign teacher form
    public function assignTeacherForm(Module $module)
    {
        $teachers = User::whereHas('role', function ($q) {
            $q->where('name', 'teacher');
        })->get();

        return view('admin.assign-teacher', compact('module', 'teachers'));
    }

    // Assign teacher to module 
    public function assignTeacher(Request $request, Module $module)
    {
    $request->validate([
        'teacher_id' => 'required|exists:users,id',
    ]);

    $module->update([
        'teacher_id' => $request->teacher_id
    ]);

    return redirect()
        ->route('admin.modules.index')
        ->with('success', 'Teacher assigned successfully.');
}

    // Show enroll student form
    public function enrollStudentForm(Module $module)
    {
        $students = User::whereHas('role', function ($q) {
            $q->where('name', 'student');
        })->get();

        return view('admin.modules.enroll-student', compact('module', 'students'));
    }

    // Store student enrollment
    public function enrollStudent(Request $request, Module $module)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $module->students()->syncWithoutDetaching($request->student_id);

        return redirect()
            ->back()
            ->with('success', 'Student enrolled successfully.');
    }
    // Student dashboard - view enrolled modules
    public function studentDashboard()
    {
    // TEMPORARY: get first student for demo purposes
    $student = User::whereHas('role', function ($q) {
        $q->where('name', 'student');
    })->first();

    if (!$student) {
        return "No student found in database.";
    }

    $modules = $student->modules;

    return view('student.dashboard', compact('modules'));
    }
}  
