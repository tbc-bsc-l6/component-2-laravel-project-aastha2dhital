<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'modulesCount'  => Module::count(),
            'teachersCount' => User::whereHas('role', fn ($q) => $q->where('role', 'teacher'))->count(),
            'studentsCount' => User::whereHas('role', fn ($q) => $q->where('role', 'student'))->count(),
        ]);
    }
}