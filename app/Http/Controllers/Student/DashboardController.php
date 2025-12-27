<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        $activeCount = $student->modules()
            ->wherePivotNull('completed_at')
            ->count();

        $completedCount = $student->modules()
            ->wherePivotNotNull('completed_at')
            ->count();

        $remainingSlots = max(0, 4 - $activeCount);

        return view('student.dashboard', compact(
            'activeCount',
            'completedCount',
            'remainingSlots'
        ));
    }
}
