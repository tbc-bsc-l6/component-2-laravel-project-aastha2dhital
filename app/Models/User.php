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

    /* ======================
     | ROLE
     |====================== */
    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    /* ======================
     | STUDENT ↔ MODULES
     |====================== */

    /**
     * Modules enrolled by a student
     * Pivot table: module_user
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class)
            ->withPivot(['enrolled_at', 'completed_at', 'pass_status'])
            ->withTimestamps();
    }

    public function activeModules(): BelongsToMany
    {
        return $this->modules()
            ->wherePivotNull('completed_at');
    }

    public function completedModules(): BelongsToMany
    {
        return $this->modules()
            ->wherePivotNotNull('completed_at');
    }

    /* Aliases used by student controllers */
    public function activeEnrollments(): BelongsToMany
    {
        return $this->activeModules();
    }

    public function completedEnrollments(): BelongsToMany
    {
        return $this->completedModules();
    }


    /**
     * Modules taught by a teacher
     * Pivot table: module_teacher
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
