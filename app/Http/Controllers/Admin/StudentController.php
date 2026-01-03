<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * CURRENT students
     */
    public function index()
    {
        $students = User::whereHas('role', fn ($q) =>
                $q->where('role', 'student')
            )
            ->whereHas('modules', fn ($q) =>
                $q->whereNull('module_user.completed_at')
            )
            ->with('activeModules')
            ->orderBy('name')
            ->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * OLD students
     */
    public function oldStudents()
    {
        $students = User::whereHas('role', fn ($q) =>
                $q->where('role', 'student')
            )
            ->whereDoesntHave('modules', fn ($q) =>
                $q->whereNull('module_user.completed_at')
            )
            ->whereHas('modules') // must have history
            ->with('completedModules')
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
