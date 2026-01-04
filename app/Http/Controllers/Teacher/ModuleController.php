<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * List modules assigned to teacher
     */
    public function index()
    {
        $modules = auth()->user()
            ->teachingModules()
            ->get();

        return view('teacher.modules.index', compact('modules'));
    }

    /**
     * Show students (ACTIVE + COMPLETED) of a module
     */
    public function students(Module $module)
    {
        // Security: teacher must own module
        abort_unless(
            $module->teachers()
                ->where('users.id', auth()->id())
                ->exists(),
            403
        );

        // Active students (not graded yet)
        $activeStudents = $module->students()
            ->wherePivotNull('completed_at')
            ->get();

        // Completed students (graded)
        $completedStudents = $module->students()
            ->wherePivotNotNull('completed_at')
            ->get();

        return view(
            'teacher.modules.students',
            compact('module', 'activeStudents', 'completedStudents')
        );
    }

    /**
     * Grade student
     */
    public function grade(Request $request, Module $module, User $user)
    {
        $request->validate([
            'pass_status' => ['required', 'in:pass,fail'],
        ]);

        // Prevent re-grading
        abort_if(
            $module->students()
                ->where('users.id', $user->id)
                ->wherePivotNotNull('completed_at')
                ->exists(),
            403,
            'Student already graded.'
        );

        $module->students()->updateExistingPivot($user->id, [
            'pass_status'  => strtoupper($request->pass_status),
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Student graded successfully.');
    }

    /**
     * Reset grade (optional feature)
     */
    public function resetGrade(Module $module, User $user)
    {
        $module->students()->updateExistingPivot($user->id, [
            'pass_status'  => null,
            'completed_at' => null,
        ]);

        return back()->with('success', 'Grade reset successfully.');
    }
}
