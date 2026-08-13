<?php

namespace Modules\LayananPrescriptionFulfillmentItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\LayananPrescriptionFulfillmentItem\Models\PrescriptionFulfillmentItem;
use Tests\TestCase;

class PrescriptionFulfillmentItemControllerTest extends TestCase
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
        $prescriptionFulfillmentId = PrescriptionFulfillment::factory()->create();
        $prescriptionItemId = PrescriptionItem::factory()->create();

        $response = $this->postJson('/api/v1/prescription-fulfillment-items', [
            'prescription_fulfillment_id' => $prescriptionFulfillmentId->id,
            'prescription_item_id' => $prescriptionItemId->id,
            'quantity_served' => 3,
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('prescription_fulfillment_items', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PrescriptionFulfillmentItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/prescription-fulfillment-items');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PrescriptionFulfillmentItem::factory()->create();

        $this->getJson("/api/v1/prescription-fulfillment-items/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PrescriptionFulfillmentItem::factory()->create();

        $this->deleteJson("/api/v1/prescription-fulfillment-items/{$record->id}")->assertStatus(204);
    }
}
