<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPatientNutritionProblem\Models\PatientNutritionProblem;
use Tests\TestCase;

class PatientNutritionProblemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        $identifiedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/patient-nutrition-problems', [
            'visit_id' => $visit->id,
            'identified_by' => $identifiedBy->id,
            'problem_category' => fake()->randomElement(['underweight','overweight','malnutrition_risk','swallowing_difficulty','poor_intake']),
            'problem_description' => fake()->sentence(8),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('patient_nutrition_problems', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PatientNutritionProblem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/patient-nutrition-problems');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/patient-nutrition-problems')->assertStatus(401);
    }
}
