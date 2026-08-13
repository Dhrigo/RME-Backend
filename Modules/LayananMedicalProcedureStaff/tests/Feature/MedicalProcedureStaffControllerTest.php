<?php

namespace Modules\LayananMedicalProcedureStaff\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\LayananMedicalProcedureStaff\Models\MedicalProcedureStaff;
use Tests\TestCase;

class MedicalProcedureStaffControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $medicalProcedureId = MedicalProcedure::factory()->create();
        $employeeId = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-procedure-staff', [
            'medical_procedure_id' => $medicalProcedureId->id,
            'employee_id' => $employeeId->id,
            'role' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('medical_procedure_staff', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        MedicalProcedureStaff::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/medical-procedure-staff');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = MedicalProcedureStaff::factory()->create();

        $this->getJson("/api/v1/medical-procedure-staff/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = MedicalProcedureStaff::factory()->create();

        $this->deleteJson("/api/v1/medical-procedure-staff/{$record->id}")->assertStatus(204);
    }
}
