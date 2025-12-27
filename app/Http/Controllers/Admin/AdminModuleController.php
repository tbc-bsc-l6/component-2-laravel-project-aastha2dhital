<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class AdminModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('admin.modules.index', compact('modules'));
    }

    public function create()
    {
        return view('admin.modules.create');
    }

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
        'module'    => $validated['module'], // ✅ CORRECT COLUMN
        'is_active' => true,
    ]);

    return redirect()
        ->route('admin.modules.index')
        ->with('success', 'Module created successfully.');
    }

    public function toggle(Module $module)
    {
        $module->update([
            'is_active' => ! $module->is_active,
        ]);

        return back()->with('success', 'Module status updated!');
    }

    /**
     * Assign teachers to a module
     */
    public function edit(Module $module)
    {
        $teachers = User::whereHas('role', function ($query) {
            $query->where('role', 'teacher');
        })->get();

        return view('admin.modules.edit', compact('module', 'teachers'));
    }

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
     * View students enrolled in a module
     */
    public function students(Module $module)
    {
        $students = $module->users()->get();

        return view('admin.modules.students', compact('module', 'students'));
    }

    /**
     * Remove a student from a module
     */
    public function removeStudent(Module $module, User $user)
    {
        // Ensure user is enrolled
        abort_unless(
            $module->users()->where('users.id', $user->id)->exists(),
            404
        );

        // Optional: ensure user is a student / old student
        abort_unless(
            in_array($user->role->role, ['student', 'old_student']),
            403
        );

        $module->users()->detach($user->id);

        return back()->with('success', 'Student removed from module successfully.');
    }
}
