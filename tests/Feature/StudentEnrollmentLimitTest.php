<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentEnrollmentLimitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A student cannot enrol in more than 4 active modules
     */
    public function test_student_cannot_enrol_in_more_than_four_modules()
    {
        // Seed required user roles (foreign key dependency)
        DB::table('user_roles')->insert([
            ['id' => 1, 'role' => 'admin'],
            ['id' => 2, 'role' => 'teacher'],
            ['id' => 3, 'role' => 'student'],
            ['id' => 4, 'role' => 'old_student'],
        ]);

        // Create a student user
        $student = User::factory()->create([
            'user_role_id' => 3,
        ]);

        // Manually create 5 modules (ONLY required columns)
        $moduleIds = [];

        for ($i = 1; $i <= 5; $i++) {
            $moduleIds[] = DB::table('modules')->insertGetId([
                'module'     => 'Test Module ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Enrol student into first 4 modules
        foreach (array_slice($moduleIds, 0, 4) as $moduleId) {
            DB::table('module_user')->insert([
                'user_id'     => $student->id,
                'module_id'   => $moduleId,
                'enrolled_at' => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // Act as student
        $this->actingAs($student);

        // Attempt to enrol in 5th module
        $response = $this->post(
            route('student.modules.enrol', $moduleIds[4])
        );
        // Should be blocked (redirect back)
        $response->assertStatus(302);

        // Student should still only have 4 active modules
        $this->assertEquals(
            4,
            DB::table('module_user')
                ->where('user_id', $student->id)
                ->whereNull('completed_at')
                ->count()
        );
    }
}
