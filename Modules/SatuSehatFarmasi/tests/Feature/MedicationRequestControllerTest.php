<?php

namespace Modules\SatuSehatFarmasi\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class MedicationRequestControllerTest extends TestCase
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
            'prescription_number' => 'A00000111222',
            'patient_id' => 'patient-1',
            'patient_name' => 'Budi Santoso',
            'encounter_id' => 'encounter-1',
            'practitioner_id' => 'practitioner-1',
            'practitioner_name' => 'dr. Budi',
            'authored_on' => '2026-08-14T03:50:00+00:00',

            'medication_local_code' => 'PCT001',
            'kfa_code' => '93006334',
            'kfa_display' => 'Paracetamol 500 mg Tablet (INDOFARMA)',
            'form_code' => 'BS066',
            'form_display' => 'Tablet',
            'ingredient_kfa_code' => '91000101',
            'ingredient_display' => 'Paracetamol',
            'strength_value' => 500,
            'strength_unit_code' => 'mg',

            'patient_instruction' => 'Diminum 3x sehari jika Demam',
            'timing_frequency' => 1,
            'timing_period' => 8,
            'timing_period_unit' => 'h',
            'dose_value' => 1,
            'dose_unit_code' => 'TAB',

            'dispense_start' => '2026-08-14T04:01:00+00:00',
            'dispense_end' => '2026-08-14T04:01:00+00:00',
            'dispense_quantity' => 10,
        ];
    }

    public function test_it_submits_medication_request_with_inline_medication(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/MedicationRequest' => Http::response(['id' => 'satusehat-medreq-1']),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/farmasi/medication-requests', $this->payload());

        $response->assertCreated();
        $this->assertSame('sent', $response->json('data.status'));

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), '/MedicationRequest')) {
                return true;
            }

            $body = $request->data();

            return $body['resourceType'] === 'MedicationRequest'
                && $body['contained'][0]['code']['coding'][0]['code'] === '93006334'
                && $body['medicationReference']['reference'] === '#REG-0001-001';
        });
    }

    public function test_guest_cannot_submit(): void
    {
        $this->postJson('/api/v1/satusehat/farmasi/medication-requests', $this->payload())->assertStatus(401);
    }
}
