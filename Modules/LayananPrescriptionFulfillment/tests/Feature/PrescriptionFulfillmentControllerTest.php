<?php

namespace Modules\LayananPrescriptionFulfillment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment;
use Tests\TestCase;

class PrescriptionFulfillmentControllerTest extends TestCase
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
        $servedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/prescription-fulfillments', [
            'prescription_id' => $prescriptionId->id,
            'served_by' => $servedBy->id,
            'served_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('prescription_fulfillments', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PrescriptionFulfillment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/prescription-fulfillments');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PrescriptionFulfillment::factory()->create();

        $this->getJson("/api/v1/prescription-fulfillments/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PrescriptionFulfillment::factory()->create();

        $this->deleteJson("/api/v1/prescription-fulfillments/{$record->id}")->assertStatus(204);
    }
}
