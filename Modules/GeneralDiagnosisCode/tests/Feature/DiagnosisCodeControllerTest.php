<?php

namespace Modules\GeneralDiagnosisCode\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Tests\TestCase;

class DiagnosisCodeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_diagnosis_code(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/diagnosis-codes', ['code' => 'A90', 'name' => 'Demam Berdarah Dengue'])
            ->assertCreated()
            ->assertJsonPath('code', 'A90');
    }

    public function test_it_searches_by_code_or_name(): void
    {
        $this->actingUser();
        DiagnosisCode::factory()->create(['code' => 'A90', 'name' => 'Demam Berdarah Dengue']);
        DiagnosisCode::factory()->create(['code' => 'J45', 'name' => 'Asma']);

        $this->getJson('/api/v1/diagnosis-codes?search=dengue')
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_it_deletes_diagnosis_code(): void
    {
        $this->actingUser();
        $code = DiagnosisCode::factory()->create();

        $this->deleteJson("/api/v1/diagnosis-codes/{$code->id}")->assertStatus(204);
    }
}
