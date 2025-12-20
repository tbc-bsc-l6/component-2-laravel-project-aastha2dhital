<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Admin-only actions
        Gate::define('is-admin', function (User $user) {
            return $user->role->name === 'admin';
        });

        // Teacher-only actions
        Gate::define('is-teacher', function (User $user) {
            return $user->role->name === 'teacher';
        });

        // Student-only actions
        Gate::define('is-student', function (User $user) {
            return $user->role->name === 'student';
        });

        // Old-student-only actions
        Gate::define('is-old-student', function (User $user) {
            return $user->role->name === 'old_student';
        });
    }
}