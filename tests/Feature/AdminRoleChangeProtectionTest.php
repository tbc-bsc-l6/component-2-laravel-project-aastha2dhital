<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminRoleChangeProtectionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Admin cannot change role of a student who has active modules
     */
    public function test_admin_cannot_change_role_if_student_has_active_modules()
    {
        // Seed user roles (foreign key dependency)
        DB::table('user_roles')->insert([
            ['id' => 1, 'role' => 'admin'],
            ['id' => 2, 'role' => 'teacher'],
            ['id' => 3, 'role' => 'student'],
            ['id' => 4, 'role' => 'old_student'],
        ]);

        // Create admin user
        $admin = User::factory()->create([
            'user_role_id' => 1,
        ]);

        // Create student user
        $student = User::factory()->create([
            'user_role_id' => 3,
        ]);

        // Create a module
        $moduleId = DB::table('modules')->insertGetId([
            'module'     => 'Active Module',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Enrol student into module (ACTIVE: completed_at = null)
        DB::table('module_user')->insert([
            'user_id'     => $student->id,
            'module_id'   => $moduleId,
            'enrolled_at' => now(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Act as admin
        $this->actingAs($admin);

        // Attempt to change student role to teacher
        $response = $this->patch(
            route('admin.students.updateRole', $student),
            ['role' => 'teacher']
        );

        // Should be blocked
        $response->assertStatus(302);

        // Role should remain STUDENT (3)
        $this->assertEquals(
            3,
            DB::table('users')->where('id', $student->id)->value('user_role_id')
        );
    }
}
