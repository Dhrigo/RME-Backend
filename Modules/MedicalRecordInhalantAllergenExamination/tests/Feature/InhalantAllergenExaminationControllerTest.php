<?php

namespace Modules\MedicalRecordInhalantAllergenExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordInhalantAllergenExamination\Models\InhalantAllergenExamination;
use Tests\TestCase;

class InhalantAllergenExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_inhalant_allergen_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 9,
            'patient_id' => 18,
            'allergen_name' => 'House Dust Mite',
            'reaction_grade' => '3+',
            'wheal_diameter_mm' => 8.0,
            'erythema_diameter_mm' => 18.0,
        ];

        $response = $this->postJson('/api/v1/inhalant-allergen-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.allergen_name', 'House Dust Mite')
            ->assertJsonPath('data.reaction_grade', '3+');

        $this->assertDatabaseHas('inhalant_allergen_examinations', ['visit_id' => 9, 'allergen_name' => 'House Dust Mite']);
    }

    public function test_it_lists_inhalant_allergen_examinations(): void
    {
        $this->actingUser();
        InhalantAllergenExamination::factory()->count(2)->create(['visit_id' => 9]);

        $response = $this->getJson('/api/v1/inhalant-allergen-examinations?visit_id=9');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_inhalant_allergen_examination(): void
    {
        $this->actingUser();
        $record = InhalantAllergenExamination::factory()->create();

        $response = $this->getJson("/api/v1/inhalant-allergen-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_inhalant_allergen_examination(): void
    {
        $this->actingUser();
        $record = InhalantAllergenExamination::factory()->create();

        $response = $this->putJson("/api/v1/inhalant-allergen-examinations/{$record->id}", [
            'interpretation' => 'Severe Sensitivity',
        ]);

        $response->assertOk()->assertJsonPath('data.interpretation', 'Severe Sensitivity');
    }

    public function test_it_deletes_an_inhalant_allergen_examination(): void
    {
        $this->actingUser();
        $record = InhalantAllergenExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/inhalant-allergen-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('inhalant_allergen_examinations', ['id' => $record->id]);
    }
}
