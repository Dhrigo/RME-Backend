<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Tests\TestCase;

class AntimicrobialStewardshipFormControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_amr_forms(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipForm::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-forms')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_form(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/antimicrobial-stewardship-forms', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'indication' => 'Test description text',
            'status' => 'draft',
        ])->assertCreated();

        $this->assertDatabaseCount('antimicrobial_stewardship_forms', 1);
    }

    public function test_it_shows_amr_form(): void
    {
        $this->actingUser();
        $amr_form = AntimicrobialStewardshipForm::factory()->create();

        $this->getJson("/api/v1/antimicrobial-stewardship-forms/{$amr_form->id}")->assertOk()->assertJsonPath('data.id', $amr_form->id);
    }

}
