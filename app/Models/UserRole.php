<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['name'];

    // A role can have many users
    public function users()
    {
        return $this->hasMany(User::class, 'user_role_id');
    }
}
