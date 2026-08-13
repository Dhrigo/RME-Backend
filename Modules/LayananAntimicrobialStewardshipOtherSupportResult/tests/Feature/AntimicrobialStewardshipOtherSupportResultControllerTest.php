<?php

namespace Modules\LayananAntimicrobialStewardshipOtherSupportResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipOtherSupportResult\Models\AntimicrobialStewardshipOtherSupportResult;
use Tests\TestCase;

class AntimicrobialStewardshipOtherSupportResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_amr_others(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipOtherSupportResult::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-other-support-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_other(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antimicrobial-stewardship-other-support-results', [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory()->create()->id,
            'examination_name' => 'Test Examination_name',
            'result_value' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('antimicrobial_stewardship_other_support_results', 1);
    }

}
