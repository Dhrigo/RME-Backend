<?php

namespace Modules\GeneralMedicalDepartmentWardAssignment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\GeneralMedicalDepartmentWardAssignment\Models\MedicalDepartmentWardAssignment;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class MedicalDepartmentWardAssignmentControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_assignments(): void
    {
        $this->actingUser();
        MedicalDepartmentWardAssignment::factory()->count(3)->create();

        $this->getJson('/api/v1/medical-department-ward-assignments')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_assignment(): void
    {
        $this->actingUser();
        $department = MedicalDepartment::factory()->create();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/medical-department-ward-assignments', [
            'medical_department_id' => $department->id,
            'ward_id' => $ward->id,
            'is_primary' => true,
        ])->assertCreated()->assertJsonPath('data.is_primary', true);

        $this->assertDatabaseHas('medical_department_ward_assignments', [
            'medical_department_id' => $department->id,
            'ward_id' => $ward->id,
        ]);
    }

    public function test_it_rejects_unknown_department(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/medical-department-ward-assignments', [
            'medical_department_id' => 99999,
            'ward_id' => $ward->id,
        ])->assertStatus(422);
    }

    public function test_it_updates_assignment(): void
    {
        $this->actingUser();
        $assignment = MedicalDepartmentWardAssignment::factory()->create(['is_primary' => true]);

        $this->putJson("/api/v1/medical-department-ward-assignments/{$assignment->id}", ['is_primary' => false])
            ->assertOk()
            ->assertJsonPath('data.is_primary', false);
    }

    public function test_it_deletes_assignment(): void
    {
        $this->actingUser();
        $assignment = MedicalDepartmentWardAssignment::factory()->create();

        $this->deleteJson("/api/v1/medical-department-ward-assignments/{$assignment->id}")->assertStatus(204);
        $this->assertDatabaseMissing('medical_department_ward_assignments', ['id' => $assignment->id]);
    }
}
