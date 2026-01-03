<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Show teacher modules
     */
    public function index()
    {
        $modules = auth()->user()
            ->teachingModules()
            ->get();

        return view('teacher.modules.index', compact('modules'));
    }

    /**
     * Show students of a module
     */
    public function show(Module $module)
    {
        // Ensure teacher is assigned to this module
        abort_unless(
            $module->teachers()
                ->where('users.id', auth()->id())
                ->exists(),
            403
        );

        // ACTIVE students only
        $students = $module->students()
            ->wherePivotNull('completed_at')
            ->get();

        return view('teacher.modules.show', compact('module', 'students'));
    }

    /**
     * Grade student (PASS / FAIL)
     */
    public function grade(Request $request, Module $module, User $user)
    {
        $request->validate([
            'pass_status' => ['required', 'in:pass,fail'],
        ]);

        // SQLite CHECK constraint requires uppercase
        $status = strtoupper($request->pass_status);

        $module->students()->updateExistingPivot($user->id, [
            'pass_status'  => $status,
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Student graded successfully.');
    }

    /**
     * Reset grade (optional feature)
     */
    public function reset(Module $module, User $user)
    {
        $module->students()->updateExistingPivot($user->id, [
            'pass_status'  => null,
            'completed_at' => null,
        ]);

        return back()->with('success', 'Grade reset successfully.');
    }
}
