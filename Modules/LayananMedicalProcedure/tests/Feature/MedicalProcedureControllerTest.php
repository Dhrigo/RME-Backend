<?php

namespace Modules\LayananMedicalProcedure\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralService\Models\Service;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class MedicalProcedureControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_performed_procedure(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $service = Service::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => $service->id,
            'performed_by' => $performedBy->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'completed');
        $this->assertDatabaseHas('medical_procedures', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_procedures_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalProcedure::factory()->count(2)->create(['visit_id' => $visit->id]);
        MedicalProcedure::factory()->create();

        $response = $this->getJson("/api/v1/medical-procedures?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_cancels_a_procedure(): void
    {
        $this->actingUser();
        $procedure = MedicalProcedure::factory()->create();

        $response = $this->putJson("/api/v1/medical-procedures/{$procedure->id}", ['status' => 'cancelled']);

        $response->assertOk()->assertJsonPath('data.status', 'cancelled');
    }

    public function test_guest_cannot_access_medical_procedures(): void
    {
        $this->getJson('/api/v1/medical-procedures')->assertStatus(401);
    }
}
