<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin role ID from user_roles table
        $adminRoleId = DB::table('user_roles')->where('role', 'admin')->value('id');

        if (!$adminRoleId) {
            // If the admin role does not exist, create it
            $adminRoleId = DB::table('user_roles')->insertGetId([
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Check if admin user already exists
        $adminEmail = 'daastha29@gmail.com';
        if (!User::where('email', $adminEmail)->exists()) {
            // Create the admin user
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make('password'), // Change to a secure password in production
                'user_role_id' => $adminRoleId,
            ]);
        }
    }
}
