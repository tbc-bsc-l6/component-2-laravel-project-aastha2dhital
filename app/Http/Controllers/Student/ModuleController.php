<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    /**
     * Show available modules for enrollment
     */
    public function index()
    {
        $student = auth()->user();

        // Show only active modules NOT currently enrolled (active only)
        $modules = Module::where('is_active', true)
            ->whereDoesntHave('users', function ($q) use ($student) {
                $q->where('users.id', $student->id)
                  ->whereNull('module_user.completed_at');
            })
            ->get();

        return view('student.modules.index', compact('modules'));
    }

    /**
     * Enroll student into a module
     */
    public function enroll(Module $module)
{
    $student = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | RULE 1: Prevent ANY duplicate enrollment (DB-safe)
    |--------------------------------------------------------------------------
    */
    $alreadyExists = DB::table('module_user')
        ->where('user_id', $student->id)
        ->where('module_id', $module->id)
        ->exists();

    if ($alreadyExists) {
        return back()->with(
            'error',
            'You have already enrolled in this module before.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RULE 2: Module capacity (max 10 ACTIVE students)
    |--------------------------------------------------------------------------
    */
    $activeStudentCount = DB::table('module_user')
        ->where('module_id', $module->id)
        ->whereNull('completed_at')
        ->count();

    if ($activeStudentCount >= 10) {
        return back()->with(
            'error',
            'This module has reached its maximum capacity.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RULE 3: Student enrollment limit (max 4 ACTIVE modules)
    |--------------------------------------------------------------------------
    */
    $activeModulesCount = DB::table('module_user')
        ->where('user_id', $student->id)
        ->whereNull('completed_at')
        ->count();

    if ($activeModulesCount >= 4) {
        return back()->with(
            'error',
            'You can only enrol in a maximum of 4 modules.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ENROLL STUDENT
    |--------------------------------------------------------------------------
    */
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
