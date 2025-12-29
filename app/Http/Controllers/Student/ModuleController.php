<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    /**
     * Show available modules for enrollment
     */
    public function index(Request $request)
    {
        $query = Module::query()
            ->where('is_active', true)
            ->withCount([
                'users as users_count' => function ($q) {
                    $q->whereNull('completed_at'); // only active students
                }
            ]);

        // SEARCH (FIXED)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $modules = $query->get()->map(function ($module) {

            // FIXED RULES
            $module->max_students = 10;

            // Check if current student already enrolled
            $module->already_enrolled = DB::table('module_user')
                ->where('module_id', $module->id)
                ->where('user_id', auth()->id())
                ->whereNull('completed_at')
                ->exists();

            // Check module capacity
            $module->is_full = $module->users_count >= $module->max_students;

            return $module;
        });

        return view('student.modules.index', compact('modules'));
    }

    /**
     * Enroll student into a module
     */
    public function enroll(Module $module)
    {
        $student = auth()->user();

        // Already enrolled check
        $alreadyExists = DB::table('module_user')
            ->where('user_id', $student->id)
            ->where('module_id', $module->id)
            ->whereNull('completed_at')
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'You are already enrolled in this module.');
        }

        // Module capacity (max 10 active students)
        $activeStudentCount = DB::table('module_user')
            ->where('module_id', $module->id)
            ->whereNull('completed_at')
            ->count();

        if ($activeStudentCount >= 10) {
            return back()->with('error', 'This module has reached its maximum capacity.');
        }

        // Student enrollment limit (max 4 active modules)
        $activeModulesCount = DB::table('module_user')
            ->where('user_id', $student->id)
            ->whereNull('completed_at')
            ->count();

        if ($activeModulesCount >= 4) {
            return back()->with('error', 'You can only enroll in a maximum of 4 modules.');
        }

        // Enroll student
        DB::table('module_user')->insert([
            'user_id'     => $student->id,
            'module_id'   => $module->id,
            'enrolled_at' => now(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return back()->with('success', 'Successfully enrolled in module.');
    }
}
