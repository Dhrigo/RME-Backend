<?php

namespace Modules\MedicalRecordTransferMedicationReconciliationItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordTransferMedicationReconciliationItem\Models\TransferMedicationReconciliationItem;
use Tests\TestCase;

class TransferMedicationReconciliationItemControllerTest extends TestCase
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
        $reconciliation = \Modules\MedicalRecordTransferMedicationReconciliation\Models\TransferMedicationReconciliation::factory()->create();

        $response = $this->postJson('/api/v1/transfer-med-reconciliation-items', [
            'reconciliation_id' => $reconciliation->id,
            'drug_name' => fake()->word(),
            'action' => fake()->randomElement(['continue','hold','discontinue','modify','new']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('transfer_medication_reconciliation_items', ['reconciliation_id' => $reconciliation->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TransferMedicationReconciliationItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/transfer-med-reconciliation-items');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/transfer-med-reconciliation-items')->assertStatus(401);
    }
}
