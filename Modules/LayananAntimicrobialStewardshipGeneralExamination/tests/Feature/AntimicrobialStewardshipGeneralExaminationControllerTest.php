<?php

namespace Modules\LayananAntimicrobialStewardshipGeneralExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipGeneralExamination\Models\AntimicrobialStewardshipGeneralExamination;
use Tests\TestCase;

class AntimicrobialStewardshipGeneralExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_amr_exams(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipGeneralExamination::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-general-examinations')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_exam(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antimicrobial-stewardship-general-examinations', [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory()->create()->id,
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('antimicrobial_stewardship_general_examinations', 1);
    }

}
