<?php

namespace Modules\MedicalRecordFoodAllergenExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordFoodAllergenExamination\Models\FoodAllergenExamination;
use Tests\TestCase;

class FoodAllergenExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_food_allergen_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 10,
            'patient_id' => 20,
            'food_item' => 'Peanut',
            'reaction_grade' => '4+',
            'wheal_diameter_mm' => 12.5,
            'symptoms_observed' => 'Anaphylaxis risk',
        ];

        $response = $this->postJson('/api/v1/food-allergen-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.food_item', 'Peanut')
            ->assertJsonPath('data.reaction_grade', '4+');

        $this->assertDatabaseHas('food_allergen_examinations', ['visit_id' => 10, 'food_item' => 'Peanut']);
    }

    public function test_it_lists_food_allergen_examinations(): void
    {
        $this->actingUser();
        FoodAllergenExamination::factory()->count(2)->create(['visit_id' => 10]);

        $response = $this->getJson('/api/v1/food-allergen-examinations?visit_id=10');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_food_allergen_examination(): void
    {
        $this->actingUser();
        $record = FoodAllergenExamination::factory()->create();

        $response = $this->getJson("/api/v1/food-allergen-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_food_allergen_examination(): void
    {
        $this->actingUser();
        $record = FoodAllergenExamination::factory()->create();

        $response = $this->putJson("/api/v1/food-allergen-examinations/{$record->id}", [
            'interpretation' => 'Avoid strict',
        ]);

        $response->assertOk()->assertJsonPath('data.interpretation', 'Avoid strict');
    }

    public function test_it_deletes_a_food_allergen_examination(): void
    {
        $this->actingUser();
        $record = FoodAllergenExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/food-allergen-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('food_allergen_examinations', ['id' => $record->id]);
    }
}
