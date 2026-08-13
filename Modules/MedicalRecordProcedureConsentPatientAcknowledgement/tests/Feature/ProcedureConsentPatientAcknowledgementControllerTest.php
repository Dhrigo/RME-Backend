<?php

namespace Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Models\ProcedureConsentPatientAcknowledgement;
use Tests\TestCase;

class ProcedureConsentPatientAcknowledgementControllerTest extends TestCase
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
        $consent = \Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent::factory()->create();

        $response = $this->postJson('/api/v1/procedure-consent-patient-acks', [
            'consent_id' => $consent->id,
            'acknowledger_name' => fake()->name(),
            'decision' => fake()->randomElement(['agree','refuse']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('procedure_consent_patient_acknowledgements', ['consent_id' => $consent->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ProcedureConsentPatientAcknowledgement::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/procedure-consent-patient-acks');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/procedure-consent-patient-acks')->assertStatus(401);
    }
}
