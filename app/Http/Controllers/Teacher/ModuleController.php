<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * List modules assigned to the logged-in teacher
     */
    public function index()
    {
        $teacher = auth()->user();

        $modules = $teacher->teachingModules()->get();

        return view('teacher.modules.index', compact('modules'));
    }

    /**
     * Show students enrolled in a module
     */
    public function show(Request $request, Module $module)
    {
    // Ensure teacher is assigned to this module
    abort_unless(
        $module->teachers()->where('users.id', auth()->id())->exists(),
        403
    );

    $search = $request->query('search');

    $students = $module->users()
        ->wherePivotNull('completed_at') // active students only
        ->when($search, function ($query) use ($search) {
            $query->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%");
        })
        ->withPivot(['enrolled_at', 'pass_status', 'completed_at'])
        ->get();

    return view('teacher.modules.show', compact('module', 'students', 'search'));
    }

    /**
     * Grade student PASS / FAIL
     */
    public function grade(Module $module, User $user, Request $request)
{
    $request->validate([
        'pass_status' => 'required|in:pass,fail',
    ]);

    // Mark module as completed
    $module->users()->updateExistingPivot($user->id, [
        'pass_status' => $request->pass_status,
        'completed_at' => now(),
    ]);

    // CHECK IF STUDENT HAS ANY ACTIVE MODULES LEFT
    $activeModulesCount = $user->modules()
        ->wherePivotNull('completed_at')
        ->count();

    // IF NONE LEFT → PROMOTE TO OLD STUDENT
    if ($activeModulesCount === 0) {
        $oldStudentRoleId = \DB::table('user_roles')
            ->where('role', 'old_student')
            ->value('id');

        $user->update([
            'user_role_id' => $oldStudentRoleId,
        ]);
    }

    return back()->with('success', 'Student graded successfully.');
}

    /**
     * Reset student grade (PASS / FAIL → NULL)
     */
    public function resetGrade(Module $module, User $user)
{
    // Ensure teacher owns module
    abort_unless(
        $module->teachers()->where('users.id', auth()->id())->exists(),
        403
    );

    // Ensure student is enrolled
    abort_unless(
        $module->users()->where('users.id', $user->id)->exists(),
        404
    );

    $module->users()->updateExistingPivot($user->id, [
        'pass_status'  => null,
        'completed_at' => null,
    ]);

    return back()->with('success', 'Student result reset successfully.');
}
}
