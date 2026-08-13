<?php

namespace Modules\GeneralAntibioticRestriction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralAntibioticRestriction\Models\AntibioticRestriction;
use Tests\TestCase;

class AntibioticRestrictionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_restrictions(): void
    {
        $this->actingUser();
        AntibioticRestriction::factory()->count(3)->create();

        $this->getJson('/api/v1/antibiotic-restrictions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_restriction(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antibiotic-restrictions', [
            'antibiotic_name' => 'Meropenem',
            'aware_category' => 'watch',
            'requires_pra_approval' => true,
        ])->assertCreated()->assertJsonPath('data.aware_category', 'watch');

        $this->assertDatabaseHas('antibiotic_restrictions', ['antibiotic_name' => 'Meropenem']);
    }

    public function test_it_rejects_invalid_aware_category(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antibiotic-restrictions', [
            'antibiotic_name' => 'Colistin',
            'aware_category' => 'invalid',
        ])->assertStatus(422);
    }

    public function test_it_rejects_duplicate_antibiotic(): void
    {
        $this->actingUser();
        AntibioticRestriction::factory()->create(['antibiotic_name' => 'Vancomycin']);

        $this->postJson('/api/v1/antibiotic-restrictions', [
            'antibiotic_name' => 'Vancomycin',
            'aware_category' => 'reserve',
        ])->assertStatus(422);
    }

    public function test_it_deletes_restriction(): void
    {
        $this->actingUser();
        $restriction = AntibioticRestriction::factory()->create();

        $this->deleteJson("/api/v1/antibiotic-restrictions/{$restriction->id}")->assertStatus(204);
        $this->assertDatabaseMissing('antibiotic_restrictions', ['id' => $restriction->id]);
    }
}
