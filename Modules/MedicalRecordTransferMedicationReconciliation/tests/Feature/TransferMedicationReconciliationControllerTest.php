<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordTransferMedicationReconciliation\Models\TransferMedicationReconciliation;
use Tests\TestCase;

class TransferMedicationReconciliationControllerTest extends TestCase
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
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        $reconciledBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();
        $transferredToWard = \Modules\GeneralWard\Models\Ward::factory()->create();

        $response = $this->postJson('/api/v1/transfer-med-reconciliations', [
            'visit_id' => $visit->id,
            'reconciled_by' => $reconciledBy->id,
            'transferred_to_ward_id' => $transferredToWard->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('transfer_medication_reconciliations', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TransferMedicationReconciliation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/transfer-med-reconciliations');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/transfer-med-reconciliations')->assertStatus(401);
    }
}
