<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role->name) {
        'admin'       => redirect()->route('admin.dashboard'),
        'teacher'     => redirect()->route('teacher.dashboard'),
        'student'     => redirect()->route('student.dashboard'),
        'old_student' => redirect()->route('old-student.dashboard'),
        default       => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

 // Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Role-Based Dashboards

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Teacher
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');
});

// Student
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard', [
            'modules' => auth()->user()->modules
        ]);
    })->name('student.dashboard');
});

// Old Student
Route::middleware(['auth', 'role:old_student'])->group(function () {
    Route::get('/old-student/dashboard', function () {
        return view('old-student.dashboard');
    })->name('old-student.dashboard');
});

require __DIR__ . '/auth.php';
