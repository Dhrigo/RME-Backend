<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordDischargeMedicationReconciliation\Models\DischargeMedicationReconciliation;
use Tests\TestCase;

class DischargeMedicationReconciliationControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/discharge-med-reconciliations', [
            'visit_id' => $visit->id,
            'reconciled_by' => $reconciledBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('discharge_medication_reconciliations', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        DischargeMedicationReconciliation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/discharge-med-reconciliations');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/discharge-med-reconciliations')->assertStatus(401);
    }
}
