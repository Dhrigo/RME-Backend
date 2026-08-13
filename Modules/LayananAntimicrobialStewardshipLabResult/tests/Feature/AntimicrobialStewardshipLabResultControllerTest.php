<?php

namespace Modules\LayananAntimicrobialStewardshipLabResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipLabResult\Models\AntimicrobialStewardshipLabResult;
use Tests\TestCase;

class AntimicrobialStewardshipLabResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_amr_labs(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipLabResult::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-lab-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_lab(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antimicrobial-stewardship-lab-results', [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory()->create()->id,
            'examination_name' => 'Test Examination_name',
            'result_value' => 'Test Result_value',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('antimicrobial_stewardship_lab_results', 1);
    }

}
