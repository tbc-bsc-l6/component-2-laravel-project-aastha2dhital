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
        'teacher_id', // keep this if column exists
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'archived_at' => 'datetime',
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
            'user_id'
        )->withTimestamps();
    }

    /**
     * Students enrolled in this module
     */
    public function students()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('enrolled_at', 'completed_at', 'pass_status')
            ->withTimestamps();
    }

    public function isArchived(): bool
    {
        return ! is_null($this->archived_at);
    }

    public function isAvailable(): bool
    {
        return $this->is_active && ! $this->isArchived();
    }

    public function activeStudentCount(): int
    {
        return $this->students()
            ->wherePivotNull('completed_at')
            ->count();
    }

    public function hasAvailableSeat(): bool
    {
        return $this->activeStudentCount() < 10;
    }
}
