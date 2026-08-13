<?php

namespace Modules\LayananLeftoverMedicationVoucherItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLeftoverMedicationVoucherItem\Models\LeftoverMedicationVoucherItem;
use Tests\TestCase;

class LeftoverMedicationVoucherItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_voucher_items(): void
    {
        $this->actingUser();
        LeftoverMedicationVoucherItem::factory()->count(3)->create();

        $this->getJson('/api/v1/leftover-medication-voucher-items')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_voucher_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/leftover-medication-voucher-items', [
            'leftover_medication_voucher_id' => \Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher::factory()->create()->id,
            'item_id' => \Modules\InventoryItem\Models\Item::factory()->create()->id,
            'quantity' => 5,
        ])->assertCreated();

        $this->assertDatabaseCount('leftover_medication_voucher_items', 1);
    }

}
