<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\ModuleController as StudentModuleController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CompletedModuleController;
use App\Http\Controllers\Teacher\ModuleController as TeacherModuleController;

/*
|--------------------------------------------------------------------------
| Root
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (ROLE BASED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $role = auth()->user()->role->role;

    return match ($role) {
        'admin'       => redirect()->route('admin.dashboard'),
        'teacher'     => redirect()->route('teacher.modules.index'),
        'student'     => redirect()->route('student.modules.index'),
        'old_student' => redirect()->route('student.history'),
        default       => abort(403),
    };
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Modules
        Route::get('/modules', [AdminModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/create', [AdminModuleController::class, 'create'])->name('modules.create');
        Route::post('/modules', [AdminModuleController::class, 'store'])->name('modules.store');
        Route::get('/modules/{module}', [AdminModuleController::class, 'show'])->name('modules.show');
        Route::get('/modules/{module}/edit', [AdminModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{module}', [AdminModuleController::class, 'update'])->name('modules.update');
        Route::patch('/modules/{module}/toggle', [AdminModuleController::class, 'toggle'])->name('modules.toggle');

        Route::get('/modules/{module}/students', [AdminModuleController::class, 'students'])
            ->name('modules.students');

        Route::delete('/modules/{module}/students/{user}', [AdminModuleController::class, 'removeStudent'])
            ->name('modules.students.remove');

        Route::get('/modules/{module}/enroll-student', [AdminModuleController::class, 'enrollStudentForm'])
            ->name('modules.enroll-student');

        Route::post('/modules/{module}/enroll-student', [AdminModuleController::class, 'enrollStudent'])
            ->name('modules.enroll-student.store');

        // Teachers
        Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers.index');
        Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
        Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
        Route::delete('/teachers/{user}', [AdminController::class, 'destroyTeacher'])
            ->name('teachers.destroy');

        // Students
        Route::get('/students', [AdminController::class, 'students'])->name('students.index');
        Route::get('/students/create', [AdminController::class, 'createStudent'])->name('students.create');
        Route::post('/students', [AdminController::class, 'storeStudent'])->name('students.store');

        Route::get('/old-students', [AdminController::class, 'oldStudents'])
            ->name('old-students.index');
    });

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES (ACTIVE STUDENT)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // Optional dashboard (not used in redirect, kept for extension)
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/modules', [StudentModuleController::class, 'index'])
            ->name('modules.index');

        Route::post('/modules/{module}/enroll', [StudentModuleController::class, 'enroll'])
            ->name('modules.enroll');

        Route::get('/completed', [CompletedModuleController::class, 'index'])
            ->name('completed');
    });

/*
|--------------------------------------------------------------------------
| OLD STUDENT ROUTES (HISTORY ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:old_student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/history', [StudentModuleController::class, 'history'])
            ->name('history');
    });

/*
|--------------------------------------------------------------------------
| TEACHER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get('/modules', [TeacherModuleController::class, 'index'])
            ->name('modules.index');

        Route::get('/modules/{module}', [TeacherModuleController::class, 'show'])
            ->name('modules.show');

        Route::post('/modules/{module}/students/{user}/grade',
            [TeacherModuleController::class, 'grade'])
            ->name('modules.grade');

        Route::post('/modules/{module}/students/{user}/reset',
            [TeacherModuleController::class, 'resetGrade'])
            ->name('modules.reset');
    });

require __DIR__.'/auth.php';
