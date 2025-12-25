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
        'module',     
        'description',
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
     * Count active (not completed) students
     */
    public function activeStudentCount(): int
    {
        return $this->users()
            ->wherePivotNull('completed_at')
            ->count();
    }

    /**
     * Check if module has available seats
     */
    public function hasAvailableSeat(): bool
    {
        return $this->activeStudentCount() < 10;
    }

    /**
     * Check if module can accept new enrolments
     */
    public function canAcceptEnrollment(): bool
    {
        return $this->is_active && $this->hasAvailableSeat();
    }
}
