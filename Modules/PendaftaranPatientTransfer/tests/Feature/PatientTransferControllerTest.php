<?php

namespace Modules\PendaftaranPatientTransfer\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranPatientTransfer\Models\PatientTransfer;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class PatientTransferControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_patient_transfers(): void
    {
        PatientTransfer::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/patienttransfers');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_patient_transfer(): void
    {
        $visit = Visit::factory()->create();
        $fromWard = Ward::factory()->create();
        $toWard = Ward::factory()->create();

        $data = [
            'visit_id' => $visit->id,
            'from_ward_id' => $fromWard->id,
            'to_ward_id' => $toWard->id,
            'transferred_at' => now()->toDateTimeString(),
            'reason' => 'Bed is full',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/patienttransfers', $data);

        $response->assertCreated()
            ->assertJsonPath('data.reason', 'Bed is full');

        $this->assertDatabaseHas('patient_transfers', $data);
    }

    public function test_can_show_patient_transfer(): void
    {
        $transfer = PatientTransfer::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/patienttransfers/{$transfer->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $transfer->id);
    }
}
