<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Show modules assigned to the teacher
     */
    public function index()
    {
        $modules = auth()->user()
            ->teachingModules()
            ->where('is_active', true)
            ->get();

        return view('teacher.modules.index', compact('modules'));
    }

    /**
     * Show students of a module
     */
    public function students(Module $module)
    {
        // Ensure teacher is assigned to this module
        abort_unless(
            auth()->user()->teachingModules->contains($module),
            403
        );

        $activeStudents = $module->students()
            ->wherePivotNull('completed_at')
            ->get();

        $completedStudents = $module->students()
            ->wherePivotNotNull('completed_at')
            ->get();

        return view('teacher.modules.students', compact(
            'module',
            'activeStudents',
            'completedStudents'
        ));
    }

    /**
     * Grade student (PASS / FAIL) — LOCKED
     */
    public function grade(Module $module, User $user, Request $request)
    {
        // Ensure teacher is assigned
        abort_unless(
            auth()->user()->teachingModules->contains($module),
            403
        );

        $request->validate([
            'result' => ['required', 'in:pass,fail'],
        ]);

        // 🔒 Check if already graded
        $alreadyCompleted = $user->modules()
            ->where('module_id', $module->id)
            ->wherePivotNotNull('completed_at')
            ->exists();

        if ($alreadyCompleted) {
            abort(403, 'This student has already been graded.');
        }

        // Save grade (uppercase as per DB)
        $user->modules()->updateExistingPivot($module->id, [
            'pass_status'  => strtoupper($request->result),
            'completed_at' => now(),
        ]);

        return back()->with(
            'success',
            'Student marked as ' . strtoupper($request->result)
        );
    }
}
