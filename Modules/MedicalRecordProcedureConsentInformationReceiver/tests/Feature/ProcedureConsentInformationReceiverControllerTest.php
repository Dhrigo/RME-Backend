<?php

namespace Modules\MedicalRecordProcedureConsentInformationReceiver\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordProcedureConsentInformationReceiver\Models\ProcedureConsentInformationReceiver;
use Tests\TestCase;

class ProcedureConsentInformationReceiverControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/procedure-consent-information-receivers', [
            'consent_id' => $consent->id,
            'receiver_name' => fake()->name(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('procedure_consent_information_receivers', ['consent_id' => $consent->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ProcedureConsentInformationReceiver::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/procedure-consent-information-receivers');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/procedure-consent-information-receivers')->assertStatus(401);
    }
}
