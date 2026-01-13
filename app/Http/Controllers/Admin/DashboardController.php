<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;

class DashboardController extends Controller
{
   public function index()
{
    $totalModules = Module::count();

    $totalTeachers = User::whereHas('role', function ($q) {
        $q->where('role', 'teacher');
    })->count();

    $totalStudents = User::whereHas('role', function ($q) {
        $q->where('role', 'student');
    })->count();

    $activeModules = Module::where('is_active', true)->whereNull('archived_at')->count();
    $archivedModules = Module::whereNotNull('archived_at')->count();

    $recentModules = Module::query()
        ->withCount('teachers')
        ->withCount([
            'students as active_students_count' => function ($q) {
                $q->wherePivotNull('completed_at');
            }
        ])
        ->latest()
        ->take(5)
        ->get();

    $fullModules = $recentModules->filter(fn ($m) => $m->active_students_count >= 10)->count();

    return view('admin.dashboard', compact(
        'totalModules',
        'totalTeachers',
        'totalStudents',
        'activeModules',
        'archivedModules',
        'fullModules',
        'recentModules'
    ));
}

}
