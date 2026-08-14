<?php

namespace Modules\SatuSehatRawatJalan\Tests\Feature;

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
            'registration_id' => 'REG-0001',
            'patient_id' => 'patient-1',
            'patient_name' => 'Budi Santoso',
            'practitioner_id' => 'practitioner-1',
            'practitioner_name' => 'dr. Budi',
            'period_start' => '2026-08-14T05:24:47+00:00',
            'location_id' => 'location-poli-1',
            'location_name' => 'Poli Penyakit Dalam',
            'service_type_code' => '419192003',
            'service_type_display' => 'Internal medicine',
        ];
    }

    public function test_it_submits_encounter_with_ambulatory_class(): void
    {
        config(['satusehat.organization_id' => 'org-1']);

        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['id' => 'satusehat-encounter-1']),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/rawat-jalan/encounters', $this->payload());

        $response->assertCreated();
        $this->assertSame('sent', $response->json('data.status'));
        $this->assertSame('satusehat-encounter-1', $response->json('data.satusehat_id'));

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), '/Encounter')) {
                return true;
            }

            $body = $request->data();

            return $body['resourceType'] === 'Encounter'
                && $body['class']['code'] === 'AMB'
                && $body['subject']['reference'] === 'Patient/patient-1'
                && $body['serviceProvider']['reference'] === 'Organization/org-1';
        });
    }

    public function test_it_marks_failed_when_satusehat_rejects(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['issue' => 'invalid'], 400),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/rawat-jalan/encounters', $this->payload());

        $response->assertStatus(422);
        $this->assertSame('failed', $response->json('data.status'));
    }

    public function test_guest_cannot_submit(): void
    {
        $this->postJson('/api/v1/satusehat/rawat-jalan/encounters', $this->payload())->assertStatus(401);
    }
}
