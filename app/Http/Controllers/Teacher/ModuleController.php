<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

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
     * Show students enrolled in a module
     */
    public function show(Module $module)
    {
        // Ensure teacher is assigned to this module
        abort_unless(
            $module->teachers()->where('users.id', auth()->id())->exists(),
            403
        );

        $students = $module->users()
            ->wherePivotNull('completed_at') // active students only
            ->withPivot(['enrolled_at', 'pass_status', 'completed_at'])
            ->get();

        return view('teacher.modules.show', compact('module', 'students'));
    }

    /**
     * Grade student PASS / FAIL
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
            'pass_status' => 'required|in:PASS,FAIL',
        ]);

        // Update pivot table
        $module->users()->updateExistingPivot($user->id, [
            'pass_status'  => $request->pass_status,
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Student graded successfully.');
    }
}
