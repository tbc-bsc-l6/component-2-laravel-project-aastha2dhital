<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'is_active',
];

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'module_teacher');
    }

    public function students()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('enrolled_at', 'completed_at', 'pass_status')
            ->withTimestamps();
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

    public function canAcceptEnrollment(): bool
    {
        return $this->is_active && $this->hasAvailableSeat();
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['enrolled_at', 'pass_status', 'completed_at'])
            ->withTimestamps();
    }
}
