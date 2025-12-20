<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/dashboard', function () {
    return 'Admin Dashboard';
})->name('admin.dashboard');

Route::get('/teacher/dashboard', function () {
    return 'Teacher Dashboard';
})->name('teacher.dashboard');

Route::get('/student/dashboard', function () {
    return view('student.dashboard', [
        'modules' => auth()->user()->modules
    ]);
})->middleware('auth')->name('student.dashboard');

Route::get('/old-student/dashboard', function () {
    return 'Old Student Dashboard';
})->name('old-student.dashboard');

require __DIR__.'/auth.php';
