<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * CURRENT STUDENTS
     */
    public function index()
    {
        $studentRole = UserRole::where('role', 'student')->first();

        $students = User::with([
                'modules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->where('user_role_id', $studentRole->id)
            ->orderBy('name')
            ->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * OLD STUDENTS
     */
    public function oldStudents()
    {
        $oldStudentRole = UserRole::where('role', 'old_student')->first();

        $students = User::with([
                'completedModules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->where('user_role_id', $oldStudentRole->id)
            ->orderBy('name')
            ->get();

        return view('admin.students.old', compact('students'));
    }

    /**
     * UPDATE USER ROLE (SAFE)
     */
    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', 'exists:user_roles,role'],
        ]);

        // Prevent self role change
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $currentRole = $user->role->role;
        $newRole     = $validated['role'];

        /*
         |------------------------------------------------------------
         | SAFETY CLEANUP BEFORE ROLE CHANGE
         |------------------------------------------------------------
         */

        // student → old_student : remove ONLY active modules
        if ($currentRole === 'student' && $newRole === 'old_student') {
            $user->modules()
                ->wherePivotNull('completed_at')
                ->detach();
        }

        // teacher → anything else : remove teaching assignments
        if ($currentRole === 'teacher' && $newRole !== 'teacher') {
            $user->teachingModules()->detach();
        }

        /*
         |------------------------------------------------------------
         | UPDATE ROLE
         |------------------------------------------------------------
         */
        $role = UserRole::where('role', $newRole)->first();

        $user->update([
            'user_role_id' => $role->id,
        ]);

        /*
         |------------------------------------------------------------
         | REDIRECT
         |------------------------------------------------------------
         */
        if ($newRole === 'old_student') {
            return redirect()
                ->route('admin.students.old')
                ->with('success', 'User moved to Old Students successfully.');
        }

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'User role updated safely.');
    }
}
