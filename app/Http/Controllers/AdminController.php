<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | MODULE ENROLMENT (ADMIN OVERRIDE)
    |--------------------------------------------------------------------------
    */
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
            'enrolled_at'  => now(),
            'completed_at' => null,
        ]);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Student enrolled successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | TEACHERS
    |--------------------------------------------------------------------------
    */
    public function teachers()
    {
        $teachers = User::whereHas('role', function ($q) {
            $q->where('role', 'teacher');
        })
         ->with('taughtModules') 
         ->orderBy('name')
         ->get();

        return view('admin.teachers', compact('teachers'));
    }

    public function createTeacher()
    {
        return view('admin.create-teacher');
    }

    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $teacherRoleId = DB::table('user_roles')
            ->where('role', 'teacher')
            ->value('id');

        User::create([
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'password'      => Hash::make($validated['password']),
            'user_role_id'  => $teacherRoleId,
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

    /*
    |--------------------------------------------------------------------------
    | STUDENTS (DERIVED STATE)
    |--------------------------------------------------------------------------
    */

    // CURRENT STUDENTS (at least 1 active module)
    public function students()
    {
        $students = User::whereHas('role', function ($q) {
                $q->where('role', 'student');
            })
            ->whereHas('modules', function ($q) {
                $q->whereNull('module_user.completed_at');
            })
            ->get();

        return view('admin.students.index', compact('students'));
    }

    // OLD STUDENTS (no active modules)
    public function oldStudents()
    {
        $students = User::whereHas('role', function ($q) {
                $q->where('role', 'student');
            })
            ->whereDoesntHave('modules', function ($q) {
                $q->whereNull('module_user.completed_at');
            })
            ->get();

        return view('admin.old-students.index', compact('students'));
    }
}
