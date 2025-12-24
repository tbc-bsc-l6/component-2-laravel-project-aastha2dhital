<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['module'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
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
}
