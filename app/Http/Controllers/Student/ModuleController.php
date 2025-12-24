<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function enroll(Module $module)
{
    $student = auth()->user();

    // 1. Module must be active and have space
    if (! $module->canAcceptEnrollment()) {
        return back()->withErrors(
            'This module is not available for enrollment.'
        );
    }

    // 2. Student max 4 active modules
    $activeModules = $student->modules()
        ->wherePivotNull('completed_at')
        ->count();

    if ($activeModules >= 4) {
        return back()->withErrors(
            'You are already enrolled in the maximum of 4 modules.'
        );
    }

    // 3. Prevent duplicate enrollment
    if ($student->modules()->where('module_id', $module->id)->exists()) {
        return back()->withErrors(
            'You are already enrolled in this module.'
        );
    }

    // 4. Enroll student
    $student->modules()->attach($module->id, [
        'enrolled_at' => now(),
    ]);

    return back()->with('success', 'Successfully enrolled in module.');
}
}
