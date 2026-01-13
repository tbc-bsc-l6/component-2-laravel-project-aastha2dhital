<?php

namespace App\Http\Controllers\OldStudent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Only completed modules for old students
        $completedModules = $user->modules()
            ->wherePivotNotNull('completed_at')
            ->withPivot(['pass_status', 'completed_at'])
            ->get();

        return view('old-student.dashboard', compact('completedModules'));
    }
}
