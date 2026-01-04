<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;

/*
|--------------------------------------------------------------------------
| Student Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Student\ModuleController as StudentModuleController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CompletedModuleController;

/*
|--------------------------------------------------------------------------
| Teacher Controllers
|--------------------------------------------------------------------------
*/
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
| Dashboard Redirect (ROLE + STATE BASED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role->role === 'teacher') {
        return redirect()->route('teacher.modules.index');
    }

    if ($user->role->role === 'student') {
        $hasActiveModules = $user->activeEnrollments()->exists();

        return $hasActiveModules
            ? redirect()->route('student.modules.index')
            : redirect()->route('student.history');
    }

    abort(403);
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

        Route::get('/modules', [AdminModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/create', [AdminModuleController::class, 'create'])->name('modules.create');
        Route::post('/modules', [AdminModuleController::class, 'store'])->name('modules.store');
        Route::get('/modules/{module}', [AdminModuleController::class, 'show'])->name('modules.show');
        Route::get('/modules/{module}/edit', [AdminModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{module}', [AdminModuleController::class, 'update'])->name('modules.update');

        Route::patch('/modules/{module}/toggle', [AdminModuleController::class, 'toggle'])->name('modules.toggle');
        Route::patch('/modules/{module}/archive', [AdminModuleController::class, 'archive'])->name('modules.archive');

        Route::get('/modules/{module}/students', [AdminModuleController::class, 'students'])
            ->name('modules.students');

        Route::delete(
            '/modules/{module}/students/{user}',
            [AdminModuleController::class, 'removeStudent']
        )->name('modules.students.remove');

        Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers.index');
        Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
        Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
        Route::delete('/teachers/{user}', [AdminController::class, 'destroyTeacher'])->name('teachers.destroy');

        Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
        Route::patch('/students/{user}/role', [AdminStudentController::class, 'updateRole'])->name('students.updateRole');
        Route::delete('/students/{user}', [AdminStudentController::class, 'destroy'])->name('students.destroy');

        Route::get('/students/old', [AdminStudentController::class, 'oldStudents'])->name('students.old');
    });

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/modules', [StudentModuleController::class, 'index'])->name('modules.index');
        Route::post('/modules/{module}/enrol', [StudentModuleController::class, 'enrol'])->name('modules.enrol');
        Route::get('/completed', [CompletedModuleController::class, 'index'])->name('completed');
        Route::get('/history', [StudentModuleController::class, 'history'])->name('history');
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

        Route::post(
            '/modules/{module}/students/{user}/grade',
            [TeacherModuleController::class, 'grade']
        )->name('modules.grade');

        Route::post(
            '/modules/{module}/students/{user}/reset',
            [TeacherModuleController::class, 'resetGrade']
        )->name('modules.reset');
    });

require __DIR__ . '/auth.php';
