<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List modules assigned to teacher
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $teacher = auth()->user();

        $modules = $teacher->teachingModules()->get();

        return view('teacher.modules.index', compact('modules'));
    }

    /*
    |--------------------------------------------------------------------------
    | Show students in a module
    |--------------------------------------------------------------------------
    */
    public function show(Module $module)
    {
        // Ensure teacher is assigned to this module
        abort_unless(
            $module->teachers()->where('users.id', auth()->id())->exists(),
            403
        );

        $students = $module->users()->get();

        return view('teacher.modules.show', compact('module', 'students'));
    }

    /*
    |--------------------------------------------------------------------------
    | Grade student (PASS / FAIL)
    |--------------------------------------------------------------------------
    */
    public function grade(Request $request, Module $module, User $user)
    {
        abort_unless(
            $module->teachers()->where('users.id', auth()->id())->exists(),
            403
        );

        $request->validate([
            'pass_status' => ['required', 'in:PASS,FAIL'],
        ]);

        $module->users()->updateExistingPivot($user->id, [
            'pass_status'  => $request->pass_status,
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Student graded successfully.');
    }

    //  Reset grade 
    
    public function resetGrade(Module $module, User $user)
    {
        abort_unless(
            $module->teachers()->where('users.id', auth()->id())->exists(),
            403
        );

        $module->users()->updateExistingPivot($user->id, [
            'pass_status'  => null,
            'completed_at' => null,
        ]);

        return back()->with('success', 'Grade reset successfully.');
    }
}
