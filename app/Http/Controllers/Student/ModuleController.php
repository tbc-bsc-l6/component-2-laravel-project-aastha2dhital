<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Show available modules for enrollment
     */
    public function index()
    {
        $student = auth()->user();

        $modules = Module::where('is_active', true)
            ->whereDoesntHave('users', function ($q) use ($student) {
                $q->where('users.id', $student->id);
            })
            ->get();

        return view('student.modules.index', compact('modules'));
    }

    /**
     * Enroll student into module
     */
    public function enroll(Module $module)
    {
        $student = auth()->user();

        // Module capacity check (max 10 active students)
        $activeStudentCount = $module->users()
            ->wherePivotNull('completed_at')
            ->count();

        if ($activeStudentCount >= 10) {
            return back()->withErrors([
                'capacity' => 'This module has reached its maximum capacity.'
            ]);
        }

        // Student enrolment limit (max 4 active modules)
        $activeModulesCount = $student->modules()
            ->wherePivotNull('completed_at')
            ->count();

        if ($activeModulesCount >= 4) {
            return back()->withErrors([
                'limit' => 'You can only enrol in a maximum of 4 modules.'
            ]);
        }

        // Prevent duplicate enrolment
        if ($student->modules()->where('modules.id', $module->id)->exists()) {
            return back()->withErrors([
                'exists' => 'You are already enrolled in this module.'
            ]);
        }

        // Enrol student
        $student->modules()->attach($module->id, [
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Successfully enrolled in module.');
    }

    /**
     * Show completed modules (PASS / FAIL history)
     */
    public function history()
    {
        $student = auth()->user();

        $modules = $student->modules()
            ->wherePivotNotNull('completed_at')
            ->get();

        return view('student.modules.history', compact('modules'));
    }
}
