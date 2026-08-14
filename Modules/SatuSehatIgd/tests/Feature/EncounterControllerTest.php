<?php

namespace Modules\SatuSehatIgd\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class EncounterControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_submits_encounter_with_emergency_class(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['id' => 'satusehat-encounter-igd-1']),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/igd/encounters', [
            'registration_id' => 'REG-IGD-0001',
            'patient_id' => 'patient-1',
            'patient_name' => 'Budi Santoso',
            'practitioner_id' => 'practitioner-1',
            'practitioner_name' => 'dr. Budi',
            'period_start' => '2026-08-14T08:40:00+00:00',
            'location_id' => 'location-igd-1',
            'location_name' => 'Ruang Triase IGD',
            'service_type_code' => '117',
            'service_type_display' => 'Emergency medicine',
        ]);

        $response->assertCreated();

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), '/Encounter')) {
                return true;
            }

            return $request->data()['class']['code'] === 'EMER';
        });
    }

    public function test_it_submits_triage_observation_with_ctas_loinc_code(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/Observation' => Http::response(['id' => 'satusehat-observation-triage-1']),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/igd/triage-observations', [
            'patient_id' => 'patient-1',
            'patient_name' => 'Budi Santoso',
            'encounter_id' => 'encounter-igd-1',
            'practitioner_id' => 'practitioner-1',
            'effective_date_time' => '2026-08-14T08:40:00+00:00',
            'triage_loinc_code' => 'LA6113-0',
            'triage_level_display' => '2',
        ]);

        $response->assertCreated();

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), '/Observation')) {
                return true;
            }

            $body = $request->data();

            return $body['code']['coding'][0]['code'] === '75910-0'
                && $body['valueCodeableConcept']['coding'][0]['code'] === 'LA6113-0';
        });
    }

    public function test_guest_cannot_submit(): void
    {
        $this->postJson('/api/v1/satusehat/igd/encounters', [])->assertStatus(401);
    }
}
