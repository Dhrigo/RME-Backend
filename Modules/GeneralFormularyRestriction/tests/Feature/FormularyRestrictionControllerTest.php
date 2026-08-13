<?php

namespace Modules\GeneralFormularyRestriction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralFormularyRestriction\Models\FormularyRestriction;
use Tests\TestCase;

class FormularyRestrictionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_restrictions(): void
    {
        $this->actingUser();
        FormularyRestriction::factory()->count(3)->create();

        $this->getJson('/api/v1/formulary-restrictions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_restriction(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/formulary-restrictions', [
            'drug_name' => 'Colistin',
            'formulary_category' => 'non_formularium',
            'requires_substitution' => true,
            'substitution_drug_name' => 'Meropenem',
        ])->assertCreated()->assertJsonPath('data.formulary_category', 'non_formularium');

        $this->assertDatabaseHas('formulary_restrictions', ['drug_name' => 'Colistin']);
    }

    public function test_it_rejects_invalid_formulary_category(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/formulary-restrictions', [
            'drug_name' => 'Colistin',
            'formulary_category' => 'invalid',
        ])->assertStatus(422);
    }

    public function test_it_rejects_duplicate_drug(): void
    {
        $this->actingUser();
        FormularyRestriction::factory()->create(['drug_name' => 'Vancomycin']);

        $this->postJson('/api/v1/formulary-restrictions', [
            'drug_name' => 'Vancomycin',
            'formulary_category' => 'fornas',
        ])->assertStatus(422);
    }

    public function test_it_deletes_restriction(): void
    {
        $this->actingUser();
        $restriction = FormularyRestriction::factory()->create();

        $this->deleteJson("/api/v1/formulary-restrictions/{$restriction->id}")->assertStatus(204);
        $this->assertDatabaseMissing('formulary_restrictions', ['id' => $restriction->id]);
    }
}
