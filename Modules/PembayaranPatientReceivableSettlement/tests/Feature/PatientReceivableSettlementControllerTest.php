<?php

namespace Modules\PembayaranPatientReceivableSettlement\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;
use Modules\PembayaranPatientReceivableSettlement\Models\PatientReceivableSettlement;
use Tests\TestCase;

class PatientReceivableSettlementControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_settlements(): void
    {
        $this->actingUser();
        PatientReceivableSettlement::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-receivable-settlements')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_settlement_and_marks_receivable_settled(): void
    {
        $user = $this->actingUser();
        $receivable = PatientReceivable::factory()->create(['status' => 'outstanding', 'amount' => 300000]);

        $this->postJson('/api/v1/patient-receivable-settlements', [
            'patient_receivable_id' => $receivable->id,
            'paid_amount' => 300000,
        ])->assertCreated()->assertJsonPath('data.received_by', $user->id);

        $this->assertDatabaseHas('patient_receivable_settlements', ['patient_receivable_id' => $receivable->id, 'received_by' => $user->id]);
        $this->assertEquals('settled', $receivable->fresh()->status);
    }

    public function test_it_shows_settlement(): void
    {
        $this->actingUser();
        $settlement = PatientReceivableSettlement::factory()->create();

        $this->getJson("/api/v1/patient-receivable-settlements/{$settlement->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $settlement->id);
    }

    public function test_it_has_no_update_or_delete_routes(): void
    {
        $this->actingUser();
        $settlement = PatientReceivableSettlement::factory()->create();

        $this->putJson("/api/v1/patient-receivable-settlements/{$settlement->id}", ['paid_amount' => 1])->assertStatus(405);
        $this->deleteJson("/api/v1/patient-receivable-settlements/{$settlement->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_settlements(): void
    {
        $this->getJson('/api/v1/patient-receivable-settlements')->assertStatus(401);
    }
}
