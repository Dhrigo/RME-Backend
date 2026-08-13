<?php

namespace Modules\InventoryShipment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryShipment\Models\Shipment;
use Tests\TestCase;

class ShipmentControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_pending_shipment(): void
    {
        $this->actingUser();
        $from = Ward::factory()->create();
        $to = Ward::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/shipments', [
            'from_ward_id' => $from->id,
            'to_ward_id' => $to->id,
            'shipped_by' => $employee->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseHas('shipments', ['from_ward_id' => $from->id, 'to_ward_id' => $to->id]);
    }

    public function test_it_rejects_shipment_to_same_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/shipments', [
            'from_ward_id' => $ward->id,
            'to_ward_id' => $ward->id,
            'shipped_by' => $employee->id,
        ])->assertStatus(422)->assertJsonValidationErrors(['from_ward_id']);
    }

    public function test_it_transitions_shipment_status(): void
    {
        $this->actingUser();
        $shipment = Shipment::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/shipments/{$shipment->id}", ['status' => 'in_transit'])
            ->assertOk()
            ->assertJsonPath('data.status', 'in_transit');
    }

    public function test_it_rejects_updating_a_delivered_shipment(): void
    {
        $this->actingUser();
        $shipment = Shipment::factory()->create(['status' => 'delivered']);

        $this->putJson("/api/v1/shipments/{$shipment->id}", ['status' => 'in_transit'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_shipments(): void
    {
        $this->getJson('/api/v1/shipments')->assertStatus(401);
    }
}
