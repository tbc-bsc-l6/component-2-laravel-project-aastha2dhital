<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* ==========================
     | ROLE
     |========================== */

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    /* ==========================
     | STUDENT ↔ MODULES
     |========================== */

    /**
     * All modules the student is/was enrolled in
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class)
            ->withPivot([
                'enrolled_at',
                'completed_at',
                'pass_status',
            ])
            ->withTimestamps();
    }

    /**
     * ACTIVE modules (current student)
     */
    public function activeModules(): BelongsToMany
    {
        return $this->modules()
            ->wherePivotNull('completed_at');
    }

    /**
     * COMPLETED modules (history / old student)
     */
    public function completedModules(): BelongsToMany
    {
        return $this->modules()
            ->wherePivotNotNull('completed_at');
    }

    /* =================================================
     | ALIASES (USED BY CONTROLLERS — DO NOT REMOVE)
     |================================================= */

    /**
     * Alias for activeModules()
     * Used by StudentModuleController
     */
    public function activeEnrollments(): BelongsToMany
    {
        return $this->activeModules();
    }

    /**
     * Alias for completedModules()
     * Used by StudentModuleController
     */
    public function completedEnrollments(): BelongsToMany
    {
        return $this->completedModules();
    }

    /* ==========================
     | TEACHER ↔ MODULES
     |========================== */

    /**
     * Modules taught by the teacher
     */
    public function teachingModules(): BelongsToMany
    {
        return $this->belongsToMany(
            Module::class,
            'module_teacher',
            'user_id',
            'module_id'
        )->withTimestamps();
    }
}
