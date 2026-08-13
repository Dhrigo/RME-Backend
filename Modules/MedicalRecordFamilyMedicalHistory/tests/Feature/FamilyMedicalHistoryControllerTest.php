<?php

namespace Modules\MedicalRecordFamilyMedicalHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordFamilyMedicalHistory\Models\FamilyMedicalHistory;
use Tests\TestCase;

class FamilyMedicalHistoryControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/family-medical-histories', [
            'visit_id' => $visit->id,
            'relation' => fake()->randomElement(['father','mother','sibling','grandparent']),
            'condition' => fake()->randomElement(['diabetes','hypertension','asthma','cancer','heart_disease']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('family_medical_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        FamilyMedicalHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/family-medical-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/family-medical-histories')->assertStatus(401);
    }
}
