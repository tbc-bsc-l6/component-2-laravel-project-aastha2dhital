<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Student module page:
     * - Active enrolled modules
     * - Available modules
     */
    public function index()
    {
        $student = auth()->user();

        // Active enrolled modules
        $enrolledModules = $student->modules()
            ->wherePivotNull('completed_at')
            ->get();

        // Available modules
        $availableModules = Module::where('is_active', 1)
            ->whereDoesntHave('students', function ($q) use ($student) {
                $q->where('user_id', $student->id)
                  ->whereNull('completed_at');
            })
            ->withCount('students')
            ->get()
            ->filter(fn ($module) => $module->students_count < 10);

        return view('student.modules.index', compact(
            'enrolledModules',
            'availableModules'
        ));
    }

    /**
     * Enrol student in a module
     */
    public function enrol(Module $module)
    {
        $student = auth()->user();

        // RULE 1: Max 4 active modules
        $activeModules = $student->modules()
            ->wherePivotNull('completed_at')
            ->count();

        if ($activeModules >= 4) {
            return back()->with('error', 'You have reached the maximum of 4 active modules.');
        }

        // RULE 2: Module capacity (max 10 students)
        if (! $module->hasAvailableSeat()) {
            return back()->with('error', 'This module is already full.');
        }

        // RULE 3: Prevent duplicate enrolment
        if ($student->modules()->where('module_id', $module->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this module.');
        }

        // Enrol student
        $student->modules()->attach($module->id, [
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Successfully enrolled in module.');
    }

    /**
     * Completed modules (Old Student view)
     */
    public function history()
    {
        $student = auth()->user();

        $completedModules = $student->modules()
            ->wherePivotNotNull('completed_at')
            ->get();

        return view('student.modules.history', compact('completedModules'));
    }
}
