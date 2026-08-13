<?php

namespace Modules\MedicalRecordUltrasoundGuidedProcedure\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordUltrasoundGuidedProcedure\Models\UltrasoundGuidedProcedure;
use Tests\TestCase;

class UltrasoundGuidedProcedureControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_ultrasound_guided_procedure(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/ultrasound-guided-procedures', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'procedure_name' => 'USG Guided Paracentesis',
            'target_site' => 'RLQ Abdomen',
            'performed_at' => '2026-08-13 16:00:00',
        ]);

        $response->assertCreated()->assertJsonPath('data.procedure_name', 'USG Guided Paracentesis');
        $this->assertDatabaseHas('ultrasound_guided_procedures', ['patient_id' => $patient->id]);
    }

    public function test_it_lists_ultrasound_guided_procedures(): void
    {
        $this->actingUser();
        $procedure = UltrasoundGuidedProcedure::factory()->create();

        $response = $this->getJson('/api/v1/ultrasound-guided-procedures');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($procedure->id, $response->json('data.0.id'));
    }

    public function test_it_shows_an_ultrasound_guided_procedure(): void
    {
        $this->actingUser();
        $procedure = UltrasoundGuidedProcedure::factory()->create();

        $response = $this->getJson("/api/v1/ultrasound-guided-procedures/{$procedure->id}");

        $response->assertOk()->assertJsonPath('data.id', $procedure->id);
    }

    public function test_it_updates_an_ultrasound_guided_procedure(): void
    {
        $this->actingUser();
        $procedure = UltrasoundGuidedProcedure::factory()->create();

        $response = $this->putJson("/api/v1/ultrasound-guided-procedures/{$procedure->id}", [
            'patient_id' => $procedure->patient_id,
            'visit_id' => $procedure->visit_id,
            'procedure_name' => $procedure->procedure_name,
            'performed_at' => $procedure->performed_at->toDateTimeString(),
            'complications' => 'None observed',
        ]);

        $response->assertOk()->assertJsonPath('data.complications', 'None observed');
    }

    public function test_it_deletes_an_ultrasound_guided_procedure(): void
    {
        $this->actingUser();
        $procedure = UltrasoundGuidedProcedure::factory()->create();

        $response = $this->deleteJson("/api/v1/ultrasound-guided-procedures/{$procedure->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('ultrasound_guided_procedures', ['id' => $procedure->id]);
    }
}
