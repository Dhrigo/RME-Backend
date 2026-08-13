<?php

namespace Modules\MedicalRecordProcedureConsentInformationItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordProcedureConsentInformationItem\Models\ProcedureConsentInformationItem;
use Tests\TestCase;

class ProcedureConsentInformationItemControllerTest extends TestCase
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
        $information = \Modules\MedicalRecordProcedureConsentInformation\Models\ProcedureConsentInformation::factory()->create();

        $response = $this->postJson('/api/v1/procedure-consent-information-items', [
            'information_id' => $information->id,
            'item_name' => fake()->randomElement(['Diagnosis','Dasar Diagnosis','Tindakan Kedokteran','Indikasi Tindakan','Tata Cara','Tujuan','Risiko','Komplikasi','Prognosis','Alternatif & Risiko']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('procedure_consent_information_items', ['information_id' => $information->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ProcedureConsentInformationItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/procedure-consent-information-items');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/procedure-consent-information-items')->assertStatus(401);
    }
}
