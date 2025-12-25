<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Student\ModuleController as StudentModuleController;
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
| Dashboard Redirect (Role-based)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $role = auth()->user()->role->role;

    return match ($role) {
        'admin'       => redirect()->route('admin.dashboard'),
        'student'     => redirect()->route('student.modules.index'),
        'teacher'     => redirect()->route('teacher.modules.index'),
        'old_student' => redirect()->route('old-student.dashboard'),
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
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Modules
        Route::get('/modules', [AdminModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/create', [AdminModuleController::class, 'create'])->name('modules.create');
        Route::post('/modules', [AdminModuleController::class, 'store'])->name('modules.store');
        Route::get('/modules/{module}/edit', [AdminModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{module}', [AdminModuleController::class, 'update'])->name('modules.update');
        Route::patch('/modules/{module}/toggle', [AdminModuleController::class, 'toggle'])->name('modules.toggle');

        // Teachers
        Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers.index');
        Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
        Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');

        // Students
        Route::get('/students', [AdminController::class, 'students'])->name('students.index');
        Route::get('/old-students', [AdminController::class, 'oldStudents'])->name('old-students.index');
    });

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/modules', [StudentModuleController::class, 'index'])
            ->name('modules.index');

        Route::post('/modules/{module}/enroll', [StudentModuleController::class, 'enroll'])
            ->name('modules.enroll');
    });

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('teacher.dashboard');
        })->name('dashboard');

        Route::get('/modules', [TeacherModuleController::class, 'index'])
            ->name('modules.index');

        Route::get('/modules/{module}', [TeacherModuleController::class, 'show'])
            ->name('modules.show');

        Route::post('/modules/{module}/students/{user}/grade',
            [TeacherModuleController::class, 'grade'])
            ->name('modules.grade');
    });

require __DIR__.'/auth.php';
