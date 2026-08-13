<?php

namespace Modules\GeneralPharmacyGuarantorMargin\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPharmacyGuarantorMargin\Models\PharmacyGuarantorMargin;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

class PharmacyGuarantorMarginControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_margins(): void
    {
        $this->actingUser();
        PharmacyGuarantorMargin::factory()->count(3)->create();

        $this->getJson('/api/v1/pharmacy-guarantor-margins')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_margin(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/pharmacy-guarantor-margins', [
            'guarantor_id' => $guarantor->id,
            'margin_percentage' => 12.5,
        ])->assertCreated()->assertJsonPath('data.margin_percentage', '12.50');

        $this->assertDatabaseHas('pharmacy_guarantor_margins', ['guarantor_id' => $guarantor->id]);
    }

    public function test_it_rejects_margin_over_100(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/pharmacy-guarantor-margins', [
            'guarantor_id' => $guarantor->id,
            'margin_percentage' => 150,
        ])->assertStatus(422);
    }

    public function test_it_updates_margin(): void
    {
        $this->actingUser();
        $margin = PharmacyGuarantorMargin::factory()->create(['margin_percentage' => 10]);

        $this->putJson("/api/v1/pharmacy-guarantor-margins/{$margin->id}", ['margin_percentage' => 15])
            ->assertOk()
            ->assertJsonPath('data.margin_percentage', '15.00');
    }

    public function test_it_deletes_margin(): void
    {
        $this->actingUser();
        $margin = PharmacyGuarantorMargin::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-guarantor-margins/{$margin->id}")->assertStatus(204);
        $this->assertDatabaseMissing('pharmacy_guarantor_margins', ['id' => $margin->id]);
    }
}
