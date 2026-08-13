<?php

namespace Modules\MedicalRecordAbciProcedure\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordAbciProcedure\Models\AbciProcedure;
use Tests\TestCase;

class AbciProcedureControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_abci_procedure(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/abci-procedures', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'procedure_date' => '2026-08-13 10:00:00',
            'indication' => 'Behavioral evaluation',
            'procedure_details' => 'Applied ABCI therapy',
            'outcome' => 'Improved response',
        ]);

        $response->assertCreated()->assertJsonPath('data.indication', 'Behavioral evaluation');
        $this->assertDatabaseHas('abci_procedures', ['patient_id' => $patient->id]);
    }

    public function test_it_lists_abci_procedures(): void
    {
        $this->actingUser();
        $procedure = AbciProcedure::factory()->create();

        $response = $this->getJson('/api/v1/abci-procedures');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($procedure->id, $response->json('data.0.id'));
    }

    public function test_it_shows_an_abci_procedure(): void
    {
        $this->actingUser();
        $procedure = AbciProcedure::factory()->create();

        $response = $this->getJson("/api/v1/abci-procedures/{$procedure->id}");

        $response->assertOk()->assertJsonPath('data.id', $procedure->id);
    }

    public function test_it_updates_an_abci_procedure(): void
    {
        $this->actingUser();
        $procedure = AbciProcedure::factory()->create();

        $response = $this->putJson("/api/v1/abci-procedures/{$procedure->id}", [
            'patient_id' => $procedure->patient_id,
            'visit_id' => $procedure->visit_id,
            'procedure_date' => $procedure->procedure_date->toDateTimeString(),
            'notes' => 'Updated notes',
        ]);

        $response->assertOk()->assertJsonPath('data.notes', 'Updated notes');
    }

    public function test_it_deletes_an_abci_procedure(): void
    {
        $this->actingUser();
        $procedure = AbciProcedure::factory()->create();

        $response = $this->deleteJson("/api/v1/abci-procedures/{$procedure->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('abci_procedures', ['id' => $procedure->id]);
    }
}
