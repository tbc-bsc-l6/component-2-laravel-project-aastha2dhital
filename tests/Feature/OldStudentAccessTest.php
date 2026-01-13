<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OldStudentAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_old_student_cannot_access_student_routes()
    {
        $oldStudentRole = UserRole::firstOrCreate(['role' => 'old_student']);

        $oldStudent = User::factory()->create([
            'user_role_id' => $oldStudentRole->id,
        ]);

        $this->actingAs($oldStudent);

        $response = $this->get('/student/modules');

        $response->assertStatus(403);
    }
}
