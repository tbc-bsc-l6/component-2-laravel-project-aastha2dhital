<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;

use App\Http\Controllers\Student\ModuleController as StudentModuleController;
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
| Dashboard Redirect (ROLE BASED ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.modules.index'),
        'student' => redirect()->route('student.modules.index'),
        default   => abort(403),
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

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('modules', AdminModuleController::class)->except(['destroy']);

        Route::patch('/modules/{module}/toggle', [AdminModuleController::class, 'toggle'])
            ->name('modules.toggle');

        Route::patch('/modules/{module}/archive', [AdminModuleController::class, 'archive'])
            ->name('modules.archive');

        Route::get('/modules/{module}/students', [AdminModuleController::class, 'students'])
            ->name('modules.students');

        Route::delete('/modules/{module}/students/{user}',
            [AdminModuleController::class, 'removeStudent']
        )->name('modules.students.remove');

        Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers.index');
        Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
        Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
        Route::delete('/teachers/{user}', [AdminController::class, 'destroyTeacher'])->name('teachers.destroy');

        Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
        Route::patch('/students/{user}/role', [AdminStudentController::class, 'updateRole'])
            ->name('students.updateRole');
        Route::delete('/students/{user}', [AdminStudentController::class, 'destroy'])
            ->name('students.destroy');

        Route::get('/students/old', [AdminStudentController::class, 'oldStudents'])
            ->name('students.old');
    });

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES (CLEAN & FINAL)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // ONE entry point
        Route::get('/modules', [StudentModuleController::class, 'index'])
            ->name('modules.index');

        Route::post('/modules/{module}/enrol', [StudentModuleController::class, 'enrol'])
            ->name('modules.enrol');

        Route::get('/completed', [CompletedModuleController::class, 'index'])
            ->name('completed');
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

        Route::get('/modules/{module}/students', [TeacherModuleController::class, 'students'])
            ->name('modules.students');

        Route::post('/modules/{module}/students/{user}/grade',
            [TeacherModuleController::class, 'grade']
        )->name('modules.grade');

        Route::post('/modules/{module}/students/{user}/reset',
            [TeacherModuleController::class, 'resetGrade']
        )->name('modules.reset');
    });

require __DIR__ . '/auth.php';
