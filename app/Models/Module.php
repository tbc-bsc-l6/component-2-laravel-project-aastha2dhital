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

    /**
     * Active student count (not completed)
     */
    public function activeStudentCount(): int
    {
        return $this->students()
            ->wherePivotNull('completed_at')
            ->count();
    }

    /**
     * Module capacity (max 10)
     */
    public function hasAvailableSeat(): bool
    {
        return $this->activeStudentCount() < 10;
    }
}
