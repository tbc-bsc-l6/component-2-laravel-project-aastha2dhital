<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
        $teachers = User::whereHas('role', function ($q) {
            $q->where('role', 'teacher');
        })->get();

        return view('admin.teachers', compact('teachers'));
    }

    public function createTeacher()
    {
        return view('admin.create-teacher');
    }

    public function storeTeacher(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $teacherRoleId = \DB::table('user_roles')
        ->where('role', 'teacher')
        ->value('id');

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_role_id' => $teacherRoleId,
    ]);

    return redirect()
        ->route('admin.teachers.index')
        ->with('success', 'Teacher created successfully.');
    }

    public function destroyTeacher(User $user)
    {
    // Ensure user is a teacher
    abort_unless($user->role->role === 'teacher', 403);

    // Detach from modules
    $user->teachingModules()->detach();

    // Delete teacher account
    $user->delete();

    return back()->with('success', 'Teacher removed successfully.');
    }

    public function students()
    {
        $students = User::whereHas('role', function ($q) {
            $q->where('role', 'student');
        })->get();

        return view('admin.modules.students', compact('students'));
    }

    public function oldStudents()
    {
        $students = User::whereHas('role', function ($q) {
            $q->where('role', 'old_student');
        })->get();

        return view('admin.old-students', compact('students'));
    }
}

