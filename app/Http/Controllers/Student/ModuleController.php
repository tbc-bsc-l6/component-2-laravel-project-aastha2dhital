<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
    $student = auth()->user();

    // Count active modules (max 4)
    $activeCount = DB::table('module_user')
        ->where('user_id', $student->id)
        ->whereNull('completed_at')
        ->count();

    // Base query
    $query = DB::table('modules')
        ->where('is_active', true);

    // 🔍 SEARCH LOGIC (REAL FIX)
    if ($request->filled('search')) {
        $query->where('module', 'like', '%' . $request->search . '%');
    }

    $modules = $query->get()->map(function ($module) use ($student) {

        $module->already_enrolled = DB::table('module_user')
            ->where('module_id', $module->id)
            ->where('user_id', $student->id)
            ->whereNull('completed_at')
            ->exists();

        $activeStudents = DB::table('module_user')
            ->where('module_id', $module->id)
            ->whereNull('completed_at')
            ->count();

        $module->is_full = $activeStudents >= 10;

        return $module;
    });

    return view('student.modules.index', [
        'modules'     => $modules,
        'activeCount' => $activeCount,
        'search'      => $request->search,
    ]);
    }

    //  Old student / completed module history
    public function history()
    {
        $completedModules = DB::table('module_user')
            ->join('modules', 'modules.id', '=', 'module_user.module_id')
            ->where('module_user.user_id', auth()->id())
            ->whereNotNull('module_user.completed_at')
            ->select(
                'modules.name',
                'modules.code',
                'module_user.completed_at',
                'module_user.pass_status'
            )
            ->orderBy('module_user.completed_at', 'desc')
            ->get();

        return view('student.history', compact('completedModules'));
    }
}
