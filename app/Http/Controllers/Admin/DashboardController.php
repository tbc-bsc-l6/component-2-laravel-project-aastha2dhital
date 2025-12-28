<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total modules
        $totalModules = Module::count();

        // Total teachers
        $totalTeachers = User::whereHas('role', function ($q) {
            $q->where('role', 'teacher');
        })->count();

        // Active students (students with at least one active module)
        $activeStudents = User::whereHas('role', function ($q) {
            $q->where('role', 'student');
        })->whereHas('modules', function ($q) {
            $q->whereNull('completed_at');
        })->count();

        // System status logic
        $systemStatus = $totalModules > 0 ? 'Operational' : 'Setup Required';

        return view('admin.dashboard', compact(
            'totalModules',
            'totalTeachers',
            'activeStudents',
            'systemStatus'
        ));
    }
}
