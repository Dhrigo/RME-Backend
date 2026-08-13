<?php

namespace Modules\GeneralAntibioticBacteriaMapping\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralAntibioticBacteriaMapping\Models\AntibioticBacteriaMapping;
use Tests\TestCase;

class AntibioticBacteriaMappingControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_mappings(): void
    {
        $this->actingUser();
        AntibioticBacteriaMapping::factory()->count(3)->create();

        $this->getJson('/api/v1/antibiotic-bacteria-mappings')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_mapping(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antibiotic-bacteria-mappings', [
            'antibiotic_name' => 'Meropenem',
            'bacteria_name' => 'Klebsiella pneumoniae',
            'sensitivity_category' => 'S',
        ])->assertCreated()->assertJsonPath('bacteria_name', 'Klebsiella pneumoniae');

        $this->assertDatabaseHas('antibiotic_bacteria_mappings', ['antibiotic_name' => 'Meropenem', 'bacteria_name' => 'Klebsiella pneumoniae']);
    }

    public function test_it_rejects_duplicate_combination(): void
    {
        $this->actingUser();
        AntibioticBacteriaMapping::factory()->create(['antibiotic_name' => 'Vancomycin', 'bacteria_name' => 'Staphylococcus aureus']);

        $this->postJson('/api/v1/antibiotic-bacteria-mappings', [
            'antibiotic_name' => 'Vancomycin',
            'bacteria_name' => 'Staphylococcus aureus',
        ])->assertStatus(422);
    }

    public function test_it_rejects_invalid_sensitivity_category(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antibiotic-bacteria-mappings', [
            'antibiotic_name' => 'Gentamicin',
            'bacteria_name' => 'Escherichia coli',
            'sensitivity_category' => 'X',
        ])->assertStatus(422);
    }

    public function test_it_deletes_mapping(): void
    {
        $this->actingUser();
        $mapping = AntibioticBacteriaMapping::factory()->create();

        $this->deleteJson("/api/v1/antibiotic-bacteria-mappings/{$mapping->id}")->assertStatus(204);
        $this->assertDatabaseMissing('antibiotic_bacteria_mappings', ['id' => $mapping->id]);
    }
}
