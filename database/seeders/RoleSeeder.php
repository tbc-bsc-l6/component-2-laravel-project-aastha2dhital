<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_roles')->insert([
            ['role' => 'admin'],
            ['role' => 'teacher'],
            ['role' => 'student'],
            ['role' => 'old_student'],
        ]);
    }
}
