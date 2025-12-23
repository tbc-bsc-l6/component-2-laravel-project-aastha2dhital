<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Teacher dashboard
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    // View modules assigned to teacher
    public function modules()
{
    $teacher = Auth::user();

    $modules = $teacher->modules; // relationship

    return view('teacher.modules', compact('modules'));
}

    // View students in a module
    public function students(Module $module)
    {
       $module->load('students');
       return view('teacher.students', compact('module'));
    }

    public function setResult(Request $request, Module $module, User $student)
{
    $request->validate([
        'status' => 'required|in:PASS,FAIL',
    ]);

    $module->students()->updateExistingPivot(
        $student->id,
        [
            'status' => $request->status,
            'completed_at' => Carbon::now(),
        ]
    );

    return back()->with('success', 'Result updated successfully.');
}
}
