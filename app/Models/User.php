<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\UserRole;
use App\Models\Module;

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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Each user belongs to a role (admin, teacher, student, old_student)
    public function role()
    {
        return $this->belongsTo(\App\Models\UserRole::class, 'user_role_id');
    }

    // A teacher teaches many modules
    public function teachingModules()
    {
        return $this->hasMany(Module::class, 'teacher_id');
    }

    // A student is enrolled in many modules
    public function modules()
    {
        return $this->belongsToMany(Module::class)
                    ->withPivot('enrolled_at', 'completed_at', 'pass_status')
                    ->withTimestamps();
    }
}
