<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Admin Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Show all modules
    Route::get('/modules', [AdminController::class, 'modules'])
        ->name('admin.modules.index');

    // Create module
    Route::get('/modules/create', [AdminController::class, 'createModule'])
        ->name('admin.modules.create');

    Route::post('/modules', [AdminController::class, 'storeModule'])
        ->name('admin.modules.store');

    // Enroll students into module
    Route::get('/modules/{module}/enroll', [AdminController::class, 'enrollStudentForm'])
        ->name('admin.modules.enroll.form');

    Route::post('/modules/{module}/enroll', [AdminController::class, 'enrollStudent'])
        ->name('admin.modules.enroll.store');

    // Assign teacher to module
    Route::get('/modules/{module}/assign', [AdminController::class, 'assignTeacherForm'])
        ->name('admin.modules.assign.form');

    Route::post('/modules/{module}/assign', [AdminController::class, 'assignTeacher'])
        ->name('admin.modules.assign.store');

    // Show all teachers
    Route::get('/teachers', [AdminController::class, 'teachers'])
        ->name('admin.teachers.index');

    // Create teacher
    Route::get('/teachers/create', [AdminController::class, 'createTeacher'])
        ->name('admin.teachers.create');

    Route::post('/teachers', [AdminController::class, 'storeTeacher'])
        ->name('admin.teachers.store');

    // Delete teacher
    Route::delete('/teachers/{id}', [AdminController::class, 'deleteTeacher'])
        ->name('admin.teachers.delete');
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {

    // Teacher Dashboard
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])
        ->name('teacher.dashboard');

    // View assigned modules
    Route::get('/modules', [TeacherController::class, 'modules'])
        ->name('teacher.modules');

    // View students in a module
    Route::get('/modules/{module}/students', [TeacherController::class, 'students'])
        ->name('teacher.modules.students');
});


// Student Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/student/dashboard', [AdminController::class, 'studentDashboard'])
        ->name('student.dashboard');
});
