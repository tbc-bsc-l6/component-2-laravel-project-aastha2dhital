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
     * Admin can change role and active modules are cleaned up
     */
    public function test_admin_can_change_role_and_active_modules_are_removed()
    {
        // Seed roles
        DB::table('user_roles')->insert([
            ['id' => 1, 'role' => 'admin'],
            ['id' => 2, 'role' => 'teacher'],
            ['id' => 3, 'role' => 'student'],
            ['id' => 4, 'role' => 'old_student'],
        ]);

        // Create admin
        $admin = User::factory()->create([
            'user_role_id' => 1,
        ]);

        // Create student
        $student = User::factory()->create([
            'user_role_id' => 3,
        ]);

        // Create module
        $moduleId = DB::table('modules')->insertGetId([
            'module'     => 'Active Module',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Enrol student (active module)
        DB::table('module_user')->insert([
            'user_id'     => $student->id,
            'module_id'   => $moduleId,
            'enrolled_at' => now(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Act as admin
        $this->actingAs($admin);

        // Change role to old_student
        $response = $this->patch(
            route('admin.students.updateRole', $student),
            ['role' => 'old_student']
        );

        // Redirect success
        $response->assertStatus(302);

        // Role should be updated
        $this->assertEquals(
            'old_student',
            $student->fresh()->role->role
        );

        // Active module should be removed
        $this->assertDatabaseMissing('module_user', [
            'user_id'   => $student->id,
            'module_id'=> $moduleId,
        ]);
    }
}
