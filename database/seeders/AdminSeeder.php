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
        //Get admin role ID
        $adminRoleId = DB::table('user_roles')->where('role', 'admin')->value('id');

        //Create the admin user 
        User::create([
            'name' => 'Admin',
            'email' => 'daastha29@gmail.com',
            'password' => Hash::make('password'),
            'user_role_id' => $adminRoleId,
]);

    }
}
