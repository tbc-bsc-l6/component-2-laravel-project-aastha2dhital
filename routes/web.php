<?php

use App\Http\Controllers\AdminController;

// Admin Dashboard
Route::get('/admin', [AdminController::class, 'dashboard']);

// Show all teachers
Route::get('/admin/teachers', [AdminController::class, 'teachers']);
Route::get('/admin/teachers/create', [AdminController::class, 'createTeacher']);
Route::post('/admin/teachers', [AdminController::class, 'storeTeacher']);
Route::delete('/admin/teachers/{id}', [AdminController::class, 'deleteTeacher']);

// Show all modules
Route::get('/admin/modules', [AdminController::class, 'modules'])->name('admin.modules');

// Assign teacher to module 
Route::get('/admin/modules/{module}/assign', [AdminController::class, 'assignTeacherForm'])->name('admin.assign.form');

// Assign teacher to module
Route::post('/admin/modules/{module}/assign', [AdminController::class, 'assignTeacher'])->name('admin.assign.submit');

// Toggle module availability
Route::post('/admin/modules/{module}/toggle', [AdminController::class, 'toggleAvailability'])->name('admin.toggle');

