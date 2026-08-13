<?php

namespace Modules\LayananPharmacyServiceTime\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPharmacyServiceTime\Models\PharmacyServiceTime;
use Tests\TestCase;

class PharmacyServiceTimeControllerTest extends TestCase
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
        $prescriptionId = Prescription::factory()->create();

        $response = $this->postJson('/api/v1/pharmacy-service-times', [
            'prescription_id' => $prescriptionId->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('pharmacy_service_times', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PharmacyServiceTime::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pharmacy-service-times');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyServiceTime::factory()->create();

        $this->getJson("/api/v1/pharmacy-service-times/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyServiceTime::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-service-times/{$record->id}")->assertStatus(204);
    }
}
