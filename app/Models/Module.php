<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'teacher_id',
    ];

    // Module belongs to a teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Module has many students
    public function students()
    {
        return $this->belongsToMany(User::class, 'module_user')
                    ->withPivot('status', 'completed_at')
                    ->withTimestamps();
    }
}
