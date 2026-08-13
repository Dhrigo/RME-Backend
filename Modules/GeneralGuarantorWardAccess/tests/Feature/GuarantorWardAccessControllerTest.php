<?php

namespace Modules\GeneralGuarantorWardAccess\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralGuarantorWardAccess\Models\GuarantorWardAccess;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

class GuarantorWardAccessControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_accesses(): void
    {
        $this->actingUser();
        GuarantorWardAccess::factory()->count(3)->create();

        $this->getJson('/api/v1/guarantor-ward-accesses')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_access(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/guarantor-ward-accesses', [
            'guarantor_id' => $guarantor->id,
            'ward_id' => $ward->id,
            'is_allowed' => true,
        ])->assertCreated()->assertJsonPath('data.is_allowed', true);

        $this->assertDatabaseHas('guarantor_ward_accesses', ['guarantor_id' => $guarantor->id, 'ward_id' => $ward->id]);
    }

    public function test_it_rejects_unknown_ward(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/guarantor-ward-accesses', [
            'guarantor_id' => $guarantor->id,
            'ward_id' => 99999,
        ])->assertStatus(422);
    }

    public function test_it_revokes_access(): void
    {
        $this->actingUser();
        $access = GuarantorWardAccess::factory()->create(['is_allowed' => true]);

        $this->putJson("/api/v1/guarantor-ward-accesses/{$access->id}", ['is_allowed' => false])
            ->assertOk()
            ->assertJsonPath('data.is_allowed', false);
    }

    public function test_it_deletes_access(): void
    {
        $this->actingUser();
        $access = GuarantorWardAccess::factory()->create();

        $this->deleteJson("/api/v1/guarantor-ward-accesses/{$access->id}")->assertStatus(204);
        $this->assertDatabaseMissing('guarantor_ward_accesses', ['id' => $access->id]);
    }
}
