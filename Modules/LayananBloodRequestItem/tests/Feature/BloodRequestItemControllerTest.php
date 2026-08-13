<?php

namespace Modules\LayananBloodRequestItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\LayananBloodRequestItem\Models\BloodRequestItem;
use Tests\TestCase;

class BloodRequestItemControllerTest extends TestCase
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
        $bloodTransfusionId = BloodTransfusion::factory()->create();

        $response = $this->postJson('/api/v1/blood-request-items', [
            'blood_transfusion_id' => $bloodTransfusionId->id,
            'blood_component' => 'Test value',
            'bag_quantity' => 3,
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('blood_request_items', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BloodRequestItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/blood-request-items');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = BloodRequestItem::factory()->create();

        $this->getJson("/api/v1/blood-request-items/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = BloodRequestItem::factory()->create();

        $this->deleteJson("/api/v1/blood-request-items/{$record->id}")->assertStatus(204);
    }
}
