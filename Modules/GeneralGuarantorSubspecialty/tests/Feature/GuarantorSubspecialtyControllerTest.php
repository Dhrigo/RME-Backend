<?php

namespace Modules\GeneralGuarantorSubspecialty\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralGuarantorSubspecialty\Models\GuarantorSubspecialty;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

class GuarantorSubspecialtyControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_subspecialties(): void
    {
        $this->actingUser();
        GuarantorSubspecialty::factory()->count(3)->create();

        $this->getJson('/api/v1/guarantor-subspecialties')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_subspecialty_coverage(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/guarantor-subspecialties', [
            'guarantor_id' => $guarantor->id,
            'subspecialty_name' => 'Bedah Saraf',
        ])->assertCreated()->assertJsonPath('data.subspecialty_name', 'Bedah Saraf');

        $this->assertDatabaseHas('guarantor_subspecialties', ['guarantor_id' => $guarantor->id, 'subspecialty_name' => 'Bedah Saraf']);
    }

    public function test_it_requires_subspecialty_name(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/guarantor-subspecialties', ['guarantor_id' => $guarantor->id])
            ->assertStatus(422);
    }

    public function test_it_updates_coverage_status(): void
    {
        $this->actingUser();
        $subspecialty = GuarantorSubspecialty::factory()->create(['is_covered' => true]);

        $this->putJson("/api/v1/guarantor-subspecialties/{$subspecialty->id}", ['is_covered' => false])
            ->assertOk()
            ->assertJsonPath('data.is_covered', false);
    }

    public function test_it_deletes_subspecialty(): void
    {
        $this->actingUser();
        $subspecialty = GuarantorSubspecialty::factory()->create();

        $this->deleteJson("/api/v1/guarantor-subspecialties/{$subspecialty->id}")->assertStatus(204);
        $this->assertDatabaseMissing('guarantor_subspecialties', ['id' => $subspecialty->id]);
    }
}
