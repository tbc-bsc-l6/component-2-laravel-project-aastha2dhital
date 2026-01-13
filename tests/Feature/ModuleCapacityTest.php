<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Module;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleCapacityTest extends TestCase
{
    use RefreshDatabase;

    public function test_module_cannot_exceed_ten_students()
    {
        $studentRole = UserRole::firstOrCreate(['role' => 'student']);

        $module = Module::factory()->create();

        $students = User::factory()->count(11)->create([
            'user_role_id' => $studentRole->id,
        ]);

        // First 10 students enrol successfully
        foreach ($students->take(10) as $student) {
            $this->actingAs($student)
                ->post(route('student.modules.enrol', $module));
        }

        // 11th student should fail
        $this->actingAs($students[10]);
        $response = $this->post(route('student.modules.enrol', $module));

        $response->assertSessionHas('error');
    }
}
