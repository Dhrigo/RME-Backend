<?php

namespace Modules\GeneralPrescriptionOriginUnitRestriction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPrescriptionOriginUnitRestriction\Models\PrescriptionOriginUnitRestriction;
use Tests\TestCase;

class PrescriptionOriginUnitRestrictionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_origin_unit_restrictions(): void
    {
        $this->actingUser();
        PrescriptionOriginUnitRestriction::factory()->count(3)->create();

        $this->getJson('/api/v1/prescription-origin-unit-restrictions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_origin_unit_restriction(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/prescription-origin-unit-restrictions', [
            'ward_id' => \Modules\GeneralWard\Models\Ward::factory()->create()->id,
        ])->assertCreated();

        $this->assertDatabaseCount('prescription_origin_unit_restrictions', 1);
    }

    public function test_it_deletes_origin_unit_restriction(): void
    {
        $this->actingUser();
        $origin_unit_restriction = PrescriptionOriginUnitRestriction::factory()->create();

        $this->deleteJson("/api/v1/prescription-origin-unit-restrictions/{$origin_unit_restriction->id}")->assertStatus(204);
        $this->assertDatabaseMissing('prescription_origin_unit_restrictions', ['id' => $origin_unit_restriction->id]);
    }

    public function test_it_shows_origin_unit_restriction(): void
    {
        $this->actingUser();
        $origin_unit_restriction = PrescriptionOriginUnitRestriction::factory()->create();

        $this->getJson("/api/v1/prescription-origin-unit-restrictions/{$origin_unit_restriction->id}")->assertOk()->assertJsonPath('data.id', $origin_unit_restriction->id);
    }

}
