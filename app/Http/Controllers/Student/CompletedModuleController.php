<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompletedModuleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $user = auth()->user();

        $completedModules = $user->modules()
            ->wherePivotNotNull('completed_at')
            ->when($search, function ($query) use ($search) {
                $query->where('modules.module', 'like', "%{$search}%");
            })
            ->withPivot(['completed_at', 'pass_status'])
            ->orderByPivot('completed_at', 'desc')
            ->get();

        return view('student.completed.index', compact('completedModules', 'search'));
    }
}
