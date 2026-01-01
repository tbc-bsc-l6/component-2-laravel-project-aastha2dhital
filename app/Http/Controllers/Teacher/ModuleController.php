<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Show ACTIVE students enrolled in a module
     */
    public function show(Request $request, Module $module)
    {
        //  Ensure teacher is assigned to this module
        abort_unless(
            $module->teachers()->where('users.id', auth()->id())->exists(),
            403
        );

        $search = $request->query('search');

        $students = $module->users()
            ->wherePivotNull('completed_at') // ACTIVE students only
            ->when($search, function ($query) use ($search) {
                $query->where('users.name', 'like', "%{$search}%")
                      ->orWhere('users.email', 'like', "%{$search}%");
            })
            ->withPivot(['created_at']) // enrolled date
            ->get();

        return view('teacher.modules.show', compact('module', 'students', 'search'));
    }

    /**
     * Grade a student (PASS / FAIL)
     */
    public function grade(Request $request, Module $module, User $user)
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

        $request->validate([
            'pass_status' => 'required|in:pass,fail',
        ]);

        // normalize to DB constraint
        $module->users()->updateExistingPivot($user->id, [
            'pass_status'  => strtoupper($request->pass_status), // PASS / FAIL
            'completed_at' => now(),
        ]);

        // Check if student has any ACTIVE modules left
        $activeModulesCount = $user->modules()
            ->wherePivotNull('completed_at')
            ->count();

        // Promote to OLD STUDENT if none left
        if ($activeModulesCount === 0) {
            $oldStudentRoleId = DB::table('user_roles')
                ->where('role', 'old_student')
                ->value('id');

            if ($oldStudentRoleId) {
                $user->update([
                    'user_role_id' => $oldStudentRoleId,
                ]);
            }
        }

        return back()->with('success', 'Student graded successfully.');
    }

    /**
     * Reset student grade (PASS / FAIL → NULL)
     */
    public function resetGrade(Module $module, User $user)
    {
        //  Ensure teacher owns module
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
