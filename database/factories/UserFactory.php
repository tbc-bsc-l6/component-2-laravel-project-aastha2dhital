<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        // Ensure student role always exists
        $studentRole = UserRole::firstOrCreate([
            'role' => 'student'
        ]);

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'user_role_id' => $studentRole->id,
        ];
    }

    public function unverified()
    {
        return $this->state(function () {
        return [
            'email_verified_at' => null,
        ];
    });
    }

}
