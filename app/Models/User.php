<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role_id',
    ];

     //The attributes that should be hidden for serialization
  
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    // A teacher teaches many modules
    public function teachingModules()
    {
        return $this->hasMany(Module::class, 'teacher_id');
    }

    // A student is enrolled in many modules
    public function enrolledModules()
    {
        return $this->belongsToMany(Module::class, 'module_user')
                    ->withPivot(['enrolled_at', 'completed_at', 'status', 'teacher_id'])
                    ->withTimestamps();
    }
}
