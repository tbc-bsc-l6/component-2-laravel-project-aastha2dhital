<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
  
    // DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // MODULES
    public function modules()
    {
        return view('admin.modules.index');
    }

    public function enrollStudentForm(Module $module)
    {
    $students = User::whereHas('role', function ($q) {
        $q->where('role', 'student');
    })->get();

    return view('admin.modules.enroll-student', compact('module', 'students'));
    }

    public function enrollStudent(Request $request, Module $module)
    {
    $request->validate([
        'student_id' => ['required', 'exists:users,id'],
    ]);

    // Prevent duplicate enrollment
    if ($module->users()->where('users.id', $request->student_id)->exists()) {
        return back()->withErrors('Student is already enrolled in this module.');
    }

    $module->users()->attach($request->student_id, [
        'enrolled_at' => now(),
        'completed_at' => null,
    ]);

    return redirect()
        ->route('admin.modules.index')
        ->with('success', 'Student enrolled successfully.');
    }

    // TEACHERS
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
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8'],
            ],
            [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters long.',
            ]
        );

        $teacherRoleId = DB::table('user_roles')
            ->where('role', 'teacher')
            ->value('id');

        if (!$teacherRoleId) {
            return back()->withErrors('Teacher role not found.');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_role_id' => $teacherRoleId,
        ]);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    public function destroyTeacher(User $user)
    {
        abort_unless($user->role->role === 'teacher', 403);

        $user->teachingModules()->detach();
        $user->delete();

        return back()->with('success', 'Teacher removed successfully.');
    }

    // STUDENTS
    
    public function students()
    {
        $students = User::whereHas('role', function ($q) {
            $q->where('role', 'student');
        })->get();

        return view('admin.students.index', compact('students'));
    }

    public function oldStudents()
    {
        $students = User::whereHas('role', function ($q) {
                $q->where('role', 'student');
            })
            ->whereDoesntHave('modules', function ($q) {
                $q->whereNull('completed_at');
            })
            ->get();

        return view('admin.old-students', compact('students'));
    }

    public function createStudent()
    {
        return view('admin.students.create');
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8'],
            ],
            [
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'password.min' => 'Password must be at least 8 characters long.',
            ]
        );

        $studentRoleId = DB::table('user_roles')
            ->where('role', 'student')
            ->value('id');

        if (!$studentRoleId) {
            return back()->withErrors('Student role not found.');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_role_id' => $studentRoleId,
        ]);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }
}
