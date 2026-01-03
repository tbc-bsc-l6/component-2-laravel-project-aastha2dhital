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

        return view('admin.dashboard', compact(
            'totalModules',
            'totalTeachers',
            'totalStudents'
        ));
    }
}