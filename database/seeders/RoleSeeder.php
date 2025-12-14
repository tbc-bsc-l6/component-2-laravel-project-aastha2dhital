<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            ['name' => 'admin'],
            ['name' => 'teacher'],
            ['name' => 'student'],
            ['name' => 'old_student'],
        ]);
    }
}
