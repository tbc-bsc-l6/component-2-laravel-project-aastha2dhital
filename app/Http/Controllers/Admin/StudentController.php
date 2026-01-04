<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * CURRENT students
     * (students who have at least one active module)
     */
    public function index()
    {
        $students = User::with([
                'role',
                'modules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->whereHas('role', function ($q) {
                $q->where('role', 'student');
            })
            ->whereHas('modules', function ($q) {
                $q->whereNull('module_user.completed_at');
            })
            ->orderBy('name')
            ->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * OLD students
     * (students who have NO active modules, but DO have history)
     */
    public function oldStudents()
    {
        $students = User::with([
                'role',
                'modules' => function ($q) {
                    $q->withPivot([
                        'enrolled_at',
                        'completed_at',
                        'pass_status',
                    ]);
                },
            ])
            ->whereHas('role', function ($q) {
                $q->where('role', 'student');
            })
            ->whereDoesntHave('modules', function ($q) {
                $q->whereNull('module_user.completed_at');
            })
            ->whereHas('modules') // must have at least one completed module
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
            abort(403);
        }

        $user->delete();

        return back()->with('success', 'Student removed successfully.');
    }
}
