<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_available',
        'teacher_id'
    ];

     // The teacher assigned to this module
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Students enrolled in this module
    public function students()
    {
        return $this->belongsToMany(User::class, 'module_user')
                    ->withPivot(['enrolled_at', 'completed_at', 'status', 'teacher_id'])
                    ->withTimestamps();
    }
}
