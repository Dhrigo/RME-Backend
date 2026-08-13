<?php

namespace Modules\MedicalRecordProcedureConsentInformationGiver\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordProcedureConsentInformationGiver\Models\ProcedureConsentInformationGiver;
use Tests\TestCase;

class ProcedureConsentInformationGiverControllerTest extends TestCase
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
        $giver = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/procedure-consent-information-givers', [
            'consent_id' => $consent->id,
            'giver_id' => $giver->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('procedure_consent_information_givers', ['consent_id' => $consent->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ProcedureConsentInformationGiver::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/procedure-consent-information-givers');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/procedure-consent-information-givers')->assertStatus(401);
    }
}
