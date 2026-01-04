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

        // 🔒 MAX 4 MODULES RULE
        if ($user->activeModules()->count() >= 4) {
            return redirect()
                ->back()
                ->with('error', 'You can only enrol in up to 4 modules.');
        }

        // Prevent double enrol
        if ($user->modules()->where('module_id', $module->id)->exists()) {
            return redirect()->back();
        }

        $user->modules()->attach($module->id, [
            'enrolled_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Module enrolled successfully.');
    }
}
