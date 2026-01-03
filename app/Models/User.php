<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    /**
     * Modules student is/was enrolled in
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class)
            ->withPivot(['pass_status', 'completed_at'])
            ->withTimestamps();
    }

    /**
     * ACTIVE modules (current student)
     */
    public function activeModules()
    {
        return $this->modules()
            ->wherePivotNull('completed_at');
    }

    /**
     * COMPLETED modules (old student / history)
     */
    public function completedModules()
    {
        return $this->modules()
            ->wherePivotNotNull('completed_at');
    }

    /**
     * Modules taught by teacher
     */
    public function taughtModules()
    {
        return $this->hasMany(Module::class, 'teacher_id');
    }
}
