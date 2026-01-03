<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'is_active',
        'archived_at',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'archived_at' => 'datetime',
    ];

    /* ============================
     | Relationships
     |============================ */

    /**
     * Teachers assigned to this module
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'module_teacher',
            'module_id',
            'user_id'
        );
    }

    /**
     * Students enrolled in this module
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'module_user',
            'module_id',
            'user_id'
        )->withPivot([
            'enrolled_at',
            'completed_at',
            'pass_status',
        ])->withTimestamps();
    }

    /* ============================
     | Helpers (IMPORTANT)
     |============================ */

    /**
     * Is module archived?
     */
    public function isArchived(): bool
    {
        return ! is_null($this->archived_at);
    }

    /**
     * Can students enrol?
     */
    public function isAvailable(): bool
    {
        return $this->is_active && ! $this->isArchived();
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
     * Max capacity = 10
     */
    public function hasAvailableSeat(): bool
    {
        return $this->activeStudentCount() < 10;
    }
}
