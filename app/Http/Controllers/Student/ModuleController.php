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

        // ACTIVE modules (not completed)
        $activeModules = $user->modules()
            ->wherePivotNull('completed_at')
            ->get();

        // COMPLETED modules
        $completedModules = $user->modules()
            ->wherePivotNotNull('completed_at')
            ->get();

        // AVAILABLE modules (student can still enrol)
        $availableModules = Module::query()
            ->where('is_active', true)
            ->whereNotIn('id', $user->modules()->pluck('modules.id'))
            ->when($search, function ($q) use ($search) {
                $q->where('module', 'like', "%{$search}%");
            })
            ->orderBy('module')
            ->get();

        return view('student.modules.index', compact(
            'activeModules',
            'completedModules',
            'availableModules',
            'search'
        ));
    }

    public function enrol(Module $module)
    {
        $user = auth()->user();

        // max 4 active modules
        if ($user->modules()->wherePivotNull('completed_at')->count() >= 4) {
            return back()->with('error', 'You can’t enrol in more than 4 active modules.');
        }

        // max 10 students per module
        if ($module->students()->wherePivotNull('completed_at')->count() >= 10) {
            return back()->with('error', 'Module is full.');
        }

        // prevent duplicate
        if ($user->modules()->where('module_id', $module->id)->exists()) {
            return back()->with('error', 'Already enrolled.');
        }

        $user->modules()->attach($module->id, [
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Successfully enrolled.');
    }
}
