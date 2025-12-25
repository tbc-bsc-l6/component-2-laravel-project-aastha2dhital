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
        $request->validate([
            'module' => 'required|string|max:255|unique:modules,module',
        ]);

        Module::create([
            'module' => $request->module,
        ]);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Module created successfully.');
    }

    public function toggle(Module $module)
    {
        $module->is_active = !$module->is_active;
        $module->save();

        return redirect()->back()->with('success', 'Module status updated!');
    }

    /**
     * Show assign teacher page
     */
    public function edit(Module $module)
    {
        $teachers = User::whereHas('role', function ($query) {
            $query->where('role', 'teacher');
        })->get();

        return view('admin.modules.edit', compact('module', 'teachers'));
    }

    /**
     * Save assigned teachers
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
}
