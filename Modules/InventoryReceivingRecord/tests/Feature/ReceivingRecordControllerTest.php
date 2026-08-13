<?php

namespace Modules\InventoryReceivingRecord\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryReceivingRecord\Models\ReceivingRecord;
use Tests\TestCase;

class ReceivingRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_receiving_record(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/receiving-records', [
            'ward_id' => $ward->id,
            'received_by' => $employee->id,
            'notes' => 'Kiriman rutin gudang farmasi',
        ]);

        $response->assertCreated()->assertJsonPath('data.ward_id', $ward->id);
        $this->assertDatabaseHas('receiving_records', ['ward_id' => $ward->id, 'received_by' => $employee->id]);
    }

    public function test_it_lists_records_filtered_by_ward_ordered_latest_first(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $older = ReceivingRecord::factory()->create(['ward_id' => $ward->id, 'received_at' => now()->subHour()]);
        $newer = ReceivingRecord::factory()->create(['ward_id' => $ward->id, 'received_at' => now()]);
        ReceivingRecord::factory()->create();

        $response = $this->getJson("/api/v1/receiving-records?ward_id={$ward->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
        $this->assertEquals($newer->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_receiving_record(): void
    {
        $this->actingUser();
        $record = ReceivingRecord::factory()->create();

        $this->getJson("/api/v1/receiving-records/{$record->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $record->id);
    }

    public function test_store_requires_ward_and_employee(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/receiving-records', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['ward_id', 'received_by']);
    }

    public function test_guest_cannot_access_receiving_records(): void
    {
        $this->getJson('/api/v1/receiving-records')->assertStatus(401);
    }
}
