<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'is_active',
    ];

    /**
     * Teachers assigned to this module
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'module_teacher',
            'module_id',
            'teacher_id'
        )->withTimestamps();
    }

    /**
     * Students enrolled in this module
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'module_user',   // ✅ CONFIRMED pivot table
            'module_id',
            'user_id'
        )
        ->withPivot(['completed_at', 'grade'])
        ->withTimestamps();
    }

    /**
     * Count only active (not completed) students
     */
    public function activeStudentCount(): int
    {
        return $this->students()
            ->wherePivotNull('completed_at')
            ->count();
    }

    /**
     * Capacity rule (max 10 students)
     */
    public function hasAvailableSeat(): bool
    {
        return $this->activeStudentCount() < 10;
    }

    /**
     * Can this module accept new enrolments?
     */
    public function canAcceptEnrollment(): bool
    {
        return $this->is_active && $this->hasAvailableSeat();
    }
}
