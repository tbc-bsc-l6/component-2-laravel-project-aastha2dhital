<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * List all students (student + old_student ONLY)
     */
    public function index()
    {
        $students = User::with([
                'role',
                'modules' => function ($q) {
                    $q->withPivot(['pass_status', 'completed_at']);
                }
            ])
            ->whereHas('role', function ($q) {
                $q->whereIn('role', ['student', 'old_student']); // ✅ FIX HERE
            })
            ->orderBy('name')
            ->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * Update user role (LIMITED)
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:student,teacher,old_student',
        ]);

        $role = UserRole::where('role', $request->role)->firstOrFail();

        $user->role()->associate($role);
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }

    /**
     * Remove user 
     */
    public function destroy(User $user)
    {
        if ($user->role->role === 'admin') {
            abort(403, 'Admin accounts cannot be removed.');
        }

        $user->delete();

        return back()->with('success', 'User removed successfully.');
    }

    /**
     * Automatically mark student as old_student
     * if all modules are completed
     */
    private function updateOldStudentStatus(User $user): void
    {
        if ($user->role->role !== 'student') {
            return;
        }

        $hasActiveModules = $user->modules()
            ->whereNull('module_user.completed_at')
            ->exists();

        if (!$hasActiveModules && $user->modules()->exists()) {
            $oldStudentRole = UserRole::where('role', 'old_student')->first();

            if ($oldStudentRole) {
                $user->role()->associate($oldStudentRole);
                $user->save();
            }
        }
    }
}
