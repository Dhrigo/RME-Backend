<?php

namespace Modules\SatuSehatRawatInap\Tests\Feature;

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

    private function payload(): array
    {
        return [
            'registration_id' => 'REG-INAP-0001',
            'patient_id' => 'patient-1',
            'patient_name' => 'Budi Santoso',
            'practitioner_id' => 'practitioner-1',
            'practitioner_name' => 'dr. Budi',
            'period_start' => '2026-08-14T08:00:00+00:00',
            'bed_location_id' => 'bed-2-ruang-210',
            'bed_location_name' => 'Bed 2, Ruang 210',
            'service_type_code' => '222',
            'service_type_display' => 'Urology',
            'service_request_id' => 'sr-pra-ranap-1',
        ];
    }

    public function test_it_submits_encounter_with_inpatient_class_and_based_on(): void
    {
        config(['satusehat.organization_id' => 'org-1']);

        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['id' => 'satusehat-encounter-2']),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/rawat-inap/encounters', $this->payload());

        $response->assertCreated();
        $this->assertSame('sent', $response->json('data.status'));

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), '/Encounter')) {
                return true;
            }

            $body = $request->data();

            return $body['resourceType'] === 'Encounter'
                && $body['class']['code'] === 'IMP'
                && $body['status'] === 'in-progress'
                && $body['basedOn'][0]['reference'] === 'ServiceRequest/sr-pra-ranap-1';
        });
    }

    public function test_guest_cannot_submit(): void
    {
        $this->postJson('/api/v1/satusehat/rawat-inap/encounters', $this->payload())->assertStatus(401);
    }
}
