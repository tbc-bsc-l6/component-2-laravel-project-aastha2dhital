<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->query('search');

        // Active (not completed)
        $activeModules = $user->activeModules()->get();

        // Completed (history)
        $completedModules = $user->completedModules()->get();

        // OLD STUDENT: only show completed
        if ($activeModules->count() === 0 && $completedModules->count() > 0) {
            return view('student.modules.index', [
                'activeModules' => collect(),
                'availableModules' => collect(),
                'completedModules' => $completedModules,
                'search' => $search,
            ]);
        }

        // Available modules (exclude already enrolled)
        $availableModules = Module::whereNotIn(
                'id',
                $user->modules()->pluck('modules.id')
            )
            ->when($search, function ($q) use ($search) {
                $q->where('module', 'like', "%{$search}%");
            })
            ->get();

        return view('student.modules.index', compact(
            'activeModules',
            'availableModules',
            'completedModules',
            'search'
        ));
    }

    public function enrol(Module $module)
{
    $user = auth()->user();

    // Max 4 active modules per student
    if ($user->activeModules()->count() >= 4) {
        return back()->with(
            'error',
            'A student can enrol in a maximum of 4 modules.'
        );
    }

    // Max 10 active students per module (USING MODEL HELPER ✅)
    if (! $module->hasAvailableSeat()) {
        return back()->with(
            'error',
            'This module already has the maximum of 10 students.'
        );
    }

    // Prevent duplicate enrolment
    if ($user->modules()->where('module_id', $module->id)->exists()) {
        return back()->with(
            'error',
            'You are already enrolled in this module.'
        );
    }

    // Enrol student
    $user->modules()->attach($module->id, [
        'enrolled_at' => now(),
    ]);

    return back()->with(
        'success',
        'Successfully enrolled in the module.'
    );
}
}
