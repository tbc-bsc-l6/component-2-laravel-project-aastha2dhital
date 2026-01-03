<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class AdminModuleController extends Controller
{
    /**
     * List all modules
     */
    public function index()
    {
        $modules = Module::orderBy('module')->get();

        return view('admin.modules.index', compact('modules'));
    }

    /**
     * Show create module form
     */
    public function create()
    {
        return view('admin.modules.create');
    }

    /**
     * Store new module
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'module' => ['required', 'string', 'max:255', 'unique:modules,module'],
            ],
            [
                'module.required' => 'Module name is required.',
                'module.unique'   => 'This module already exists.',
            ]
        );

        Module::create([
            'module'    => $validated['module'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Module created successfully.');
    }

    /**
     * Toggle active / inactive
     */
    public function toggle(Module $module)
    {
        if ($module->isArchived()) {
            return back()->with('error', 'Archived modules cannot be activated.');
        }

        $module->update([
            'is_active' => ! $module->is_active,
        ]);

        return back()->with('success', 'Module availability updated.');
    }

    /**
     * Archive or restore module
     */
    public function archive(Module $module)
    {
        // Restore
        if ($module->isArchived()) {
            $module->update([
                'archived_at' => null,
                'is_active'   => false,
            ]);

            return back()->with('success', 'Module restored successfully.');
        }

        // Archive
        $module->update([
            'archived_at' => now(),
            'is_active'   => false,
        ]);

        return back()->with('success', 'Module archived successfully.');
    }

    /**
     * Assign teachers
     */
    public function edit(Module $module)
    {
        $teachers = User::whereHas('role', function ($q) {
            $q->where('role', 'teacher');
        })->get();

        return view('admin.modules.edit', compact('module', 'teachers'));
    }

    /**
     * Save teacher assignments
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'teachers' => 'nullable|array',
        ]);

        $module->teachers()->sync($request->teachers ?? []);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Teachers assigned successfully.');
    }

    /**
     * View students in a module
     */
    public function students(Module $module)
    {
        $students = $module->students()->with('role')->get();

        return view('admin.modules.students', compact('module', 'students'));
    }

    /**
     * Remove student from module
     */
    public function removeStudent(Module $module, User $user)
    {
        abort_unless(
            $module->students()->where('users.id', $user->id)->exists(),
            404
        );

        abort_unless(
            in_array($user->role->role, ['student', 'old_student']),
            403
        );

        $module->students()->detach($user->id);

        return back()->with('success', 'Student removed from module successfully.');
    }
}
