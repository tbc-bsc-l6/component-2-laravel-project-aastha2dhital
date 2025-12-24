<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;

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
        // Security: ensure teacher is assigned to this module
        abort_unless(
            $module->teachers()->where('users.id', auth()->id())->exists(),
            403
        );

        $students = $module->users()
            ->whereIn('user_role_id', [3, 4]) // student + old_student
            ->withPivot(['enrolled_at', 'pass_status', 'completed_at'])
            ->get();

        return view('teacher.modules.show', compact('module', 'students'));
    }
}
