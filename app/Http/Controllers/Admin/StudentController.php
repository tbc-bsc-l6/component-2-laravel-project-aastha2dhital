<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;

class StudentController extends Controller
{
    /**
     * Show all students with module pass/fail status
     */
    public function index()
    {
        $students = User::with([
                'role',
                'modules' => function ($q) {
                    $q->withPivot('status', 'enrolled_at', 'completed_at');
                }
            ])
            ->whereHas('role', function ($q) {
                $q->whereIn('role', ['student', 'old_student']);
            })
            ->get();

        $roles = UserRole::all();

        return view('admin.students.index', compact('students', 'roles'));
    }

    /**
     * Update a user's role
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:user_roles,id',
        ]);

        $user->role_id = $request->role_id;
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }

    /**
     * Remove a student
     */
    public function destroy(User $user)
    {
        if ($user->role->role === 'admin') {
            return back()->with('error', 'Admin users cannot be removed.');
        }

        $user->delete();

        return back()->with('success', 'Student removed successfully.');
    }
}
