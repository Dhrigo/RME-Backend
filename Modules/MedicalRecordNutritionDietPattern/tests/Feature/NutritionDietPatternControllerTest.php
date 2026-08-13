<?php

namespace Modules\MedicalRecordNutritionDietPattern\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordNutritionDietPattern\Models\NutritionDietPattern;
use Tests\TestCase;

class NutritionDietPatternControllerTest extends TestCase
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
        $assessedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/nutrition-diet-patterns', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'diet_type' => fake()->randomElement(['regular','soft','liquid','diabetic','low_salt']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('nutrition_diet_patterns', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        NutritionDietPattern::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/nutrition-diet-patterns');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/nutrition-diet-patterns')->assertStatus(401);
    }
}
