<?php

namespace Modules\LayananLeftoverMedicationVoucher\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher;
use Tests\TestCase;

class LeftoverMedicationVoucherControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_vouchers(): void
    {
        $this->actingUser();
        LeftoverMedicationVoucher::factory()->count(3)->create();

        $this->getJson('/api/v1/leftover-medication-vouchers')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_voucher(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/leftover-medication-vouchers', [
            'voucher_number' => 'Test Voucher_number',
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'status' => 'pending',
            'issued_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('leftover_medication_vouchers', 1);
    }

    public function test_it_shows_voucher(): void
    {
        $this->actingUser();
        $voucher = LeftoverMedicationVoucher::factory()->create();

        $this->getJson("/api/v1/leftover-medication-vouchers/{$voucher->id}")->assertOk()->assertJsonPath('data.id', $voucher->id);
    }

}
