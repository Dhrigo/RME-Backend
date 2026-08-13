<?php

namespace Modules\LayananPharmacyReturn\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\LayananPharmacyReturn\Models\PharmacyReturn;
use Tests\TestCase;

class PharmacyReturnControllerTest extends TestCase
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
        $prescriptionItemId = PrescriptionItem::factory()->create();
        $returnedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/pharmacy-returns', [
            'prescription_item_id' => $prescriptionItemId->id,
            'quantity_returned' => 3,
            'reason' => 'Test value',
            'returned_by' => $returnedBy->id,
            'returned_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('pharmacy_returns', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PharmacyReturn::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pharmacy-returns');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyReturn::factory()->create();

        $this->getJson("/api/v1/pharmacy-returns/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyReturn::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-returns/{$record->id}")->assertStatus(204);
    }
}
