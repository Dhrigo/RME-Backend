<?php

namespace Modules\MedicalRecordProcedureConsentInformation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordProcedureConsentInformation\Models\ProcedureConsentInformation;
use Tests\TestCase;

class ProcedureConsentInformationControllerTest extends TestCase
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
        $explainedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/procedure-consent-information', [
            'consent_id' => $consent->id,
            'explained_by' => $explainedBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('procedure_consent_information', ['consent_id' => $consent->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ProcedureConsentInformation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/procedure-consent-information');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/procedure-consent-information')->assertStatus(401);
    }
}
