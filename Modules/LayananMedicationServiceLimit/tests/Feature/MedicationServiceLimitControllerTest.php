<?php

namespace Modules\LayananMedicationServiceLimit\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananMedicationServiceLimit\Models\MedicationServiceLimit;
use Tests\TestCase;

class MedicationServiceLimitControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_service_limits(): void
    {
        $this->actingUser();
        MedicationServiceLimit::factory()->count(3)->create();

        $this->getJson('/api/v1/medication-service-limits')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_service_limit(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/medication-service-limits', [
            'item_id' => \Modules\InventoryItem\Models\Item::factory()->create()->id,
            'max_quantity_per_month' => 5,
        ])->assertCreated();

        $this->assertDatabaseCount('medication_service_limits', 1);
    }

    public function test_it_deletes_service_limit(): void
    {
        $this->actingUser();
        $service_limit = MedicationServiceLimit::factory()->create();

        $this->deleteJson("/api/v1/medication-service-limits/{$service_limit->id}")->assertStatus(204);
        $this->assertDatabaseMissing('medication_service_limits', ['id' => $service_limit->id]);
    }

    public function test_it_shows_service_limit(): void
    {
        $this->actingUser();
        $service_limit = MedicationServiceLimit::factory()->create();

        $this->getJson("/api/v1/medication-service-limits/{$service_limit->id}")->assertOk()->assertJsonPath('data.id', $service_limit->id);
    }

}
