<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;

class AdminModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('name')->get();

        return view('admin.modules.index', compact('modules'));
    }

    public function toggle(Module $module)
    {
        $module->is_active = ! $module->is_active;
        $module->save();

        return back()->with('success', 'Module availability updated.');
    }
}