<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Module extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'module_name',
        'module_code',
        'is_active',
    ];

    /**
     * Teachers assigned to this module
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'module_teacher');
    }

    /**
     * Students enrolled in this module
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['enrolled_at', 'completed_at', 'pass_status'])
            ->withTimestamps();
    }

    /**
     * Active (not completed) students count
     */
    public function activeStudentCount(): int
    {
        return $this->users()
            ->wherePivotNull('completed_at')
            ->count();
    }

    /**
     * Module capacity check (max 10 students)
     */
    public function hasAvailableSeat(): bool
    {
        return $this->activeStudentCount() < 10;
    }

    /**
     * Can accept new enrollments?
     */
    public function canAcceptEnrollment(): bool
    {
        return $this->is_active && $this->hasAvailableSeat();
    }
}
