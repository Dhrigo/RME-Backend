<?php

namespace Modules\GeneralDiagnosisRestriction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\GeneralDiagnosisRestriction\Models\DiagnosisRestriction;
use Tests\TestCase;

class DiagnosisRestrictionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_restrictions(): void
    {
        $this->actingUser();
        DiagnosisRestriction::factory()->count(3)->create();

        $this->getJson('/api/v1/diagnosis-restrictions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_restriction(): void
    {
        $this->actingUser();
        $diagnosis = DiagnosisCode::factory()->create();

        $this->postJson('/api/v1/diagnosis-restrictions', [
            'diagnosis_code_id' => $diagnosis->id,
            'restricted_antibiotic_name' => 'Meropenem',
        ])->assertCreated()->assertJsonPath('data.restricted_antibiotic_name', 'Meropenem');

        $this->assertDatabaseHas('diagnosis_restrictions', ['diagnosis_code_id' => $diagnosis->id, 'restricted_antibiotic_name' => 'Meropenem']);
    }

    public function test_it_rejects_unknown_diagnosis(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/diagnosis-restrictions', [
            'diagnosis_code_id' => 99999,
            'restricted_antibiotic_name' => 'Meropenem',
        ])->assertStatus(422);
    }

    public function test_it_updates_restriction(): void
    {
        $this->actingUser();
        $restriction = DiagnosisRestriction::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/diagnosis-restrictions/{$restriction->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_restriction(): void
    {
        $this->actingUser();
        $restriction = DiagnosisRestriction::factory()->create();

        $this->deleteJson("/api/v1/diagnosis-restrictions/{$restriction->id}")->assertStatus(204);
        $this->assertDatabaseMissing('diagnosis_restrictions', ['id' => $restriction->id]);
    }
}
