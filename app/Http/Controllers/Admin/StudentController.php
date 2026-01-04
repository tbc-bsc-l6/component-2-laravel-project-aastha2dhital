<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * CURRENT students
     * Students who have at least ONE active module
     */
    public function index()
    {
        $students = User::with([
                'role',
                'activeModules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->whereHas('role', fn ($q) =>
                $q->where('role', 'student')
            )
            ->whereHas('activeModules')
            ->orderBy('name')
            ->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * OLD students
     * Students who have NO active modules but DO have completed modules
     */
    public function oldStudents()
    {
        $students = User::with([
                'role',
                'completedModules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->whereHas('role', fn ($q) =>
                $q->where('role', 'student')
            )
            ->whereDoesntHave('activeModules')
            ->whereHas('completedModules')
            ->orderBy('name')
            ->get();

        return view('admin.students.old', compact('students'));
    }

    /**
     * Remove student
     */
    public function destroy(User $user)
    {
        if ($user->role->role === 'admin') {
            abort(403, 'Admin accounts cannot be removed.');
        }

        $user->delete();

        return back()->with('success', 'Student removed successfully.');
    }
}
