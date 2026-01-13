<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * CURRENT STUDENTS
     * user_role_id = 3 (student)
     */
    public function index()
    {
        $students = User::with([
                'modules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->where('user_role_id', 3) // student
            ->orderBy('name')
            ->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * OLD STUDENTS
     * user_role_id = 4 (old_student)
     */
    public function oldStudents()
    {
        $students = User::with([
                'completedModules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->where('user_role_id', 4) // old_student
            ->orderBy('name')
            ->get();

        return view('admin.students.old', compact('students'));
    }

    /**
     * UPDATE STUDENT ROLE
     * student (3), teacher (2), old_student (4)
     */
    public function updateRole(Request $request, User $user)
{
    $validated = $request->validate([
        'role' => ['required', 'in:student,teacher,old_student'],
    ]);

  
    if ($user->id === auth()->id()) {
        return back()->with('error', 'You cannot change your own role.');
    }

   
    $hasActiveModules = $user->modules()
        ->wherePivotNull('completed_at')
        ->exists();

    if ($hasActiveModules) {
        return back()->with(
            'error',
            'Role cannot be changed while the student has active modules.'
        );
    }

    $roleMap = [
        'admin'       => 1,
        'teacher'     => 2,
        'student'     => 3,
        'old_student' => 4,
    ];

    $user->update([
        'user_role_id' => $roleMap[$validated['role']],
    ]);

    
    if ($validated['role'] === 'old_student') {
        return redirect()
            ->route('admin.students.old')
            ->with('success', 'Student moved to Old Students.');
    }

    return redirect()
        ->route('admin.students.index')
        ->with('success', 'Student role updated successfully.');
}

}
