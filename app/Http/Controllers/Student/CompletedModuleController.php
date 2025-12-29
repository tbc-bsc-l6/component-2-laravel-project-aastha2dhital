<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompletedModuleController extends Controller
{
     public function index()
    {
        $completedModules = auth()->user()
            ->modules()
            ->wherePivotNotNull('completed_at')
            ->get();

        return view('student.modules.completed', compact('completedModules'));
    }
}
    

