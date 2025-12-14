<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed user roles (admin, teacher, student, old_student)
        $this->call(RoleSEeder::class);

        // Seed admin user (ONLY created through seeder)
        @this->call(AdminSeeder::class);
    }
}
