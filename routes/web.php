<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role->role) {
        'admin' => redirect()->route('admin.dashboard'),
        default => abort(403),
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

        Route::get('/modules', [AdminModuleController::class, 'index'])
            ->name('modules.index');

        Route::get('/modules/create', [AdminModuleController::class, 'create'])
            ->name('modules.create');

        Route::post('/modules', [AdminModuleController::class, 'store'])
            ->name('modules.store');

        Route::patch('/modules/{module}/toggle', [AdminModuleController::class, 'toggle'])
            ->name('modules.toggle');
    });

require __DIR__.'/auth.php';
