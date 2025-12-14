<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    // Show create teacher page (form will come next)
    public function createTeacher()
    {
          return view('admin.create-teacher');
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $teacherRole = UserRole::where('name', 'teacher')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_role_id' => $teacherRole->id,
        ]);

        return redirect('/admin/teachers');
    }

    public function deleteTeacher($id)
    {
    $teacher = User::findOrFail($id);
    $teacher->delete();

    return redirect('/admin/teachers');
    }

    // List all modules (placeholder for now)
    public function modules()
    {
        return view('admin.modules');
    }
}
