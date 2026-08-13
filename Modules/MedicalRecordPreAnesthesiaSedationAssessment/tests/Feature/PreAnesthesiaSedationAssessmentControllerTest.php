<?php

namespace Modules\MedicalRecordPreAnesthesiaSedationAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPreAnesthesiaSedationAssessment\Models\PreAnesthesiaSedationAssessment;
use Tests\TestCase;

class PreAnesthesiaSedationAssessmentControllerTest extends TestCase
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
        $doctor = \Modules\GeneralDoctor\Models\Doctor::factory()->create();

        $response = $this->postJson('/api/v1/pre-anesthesia-sedation-assessments', [
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'asa_classification' => fake()->randomElement(['I','II','III','IV']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('pre_anesthesia_sedation_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PreAnesthesiaSedationAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pre-anesthesia-sedation-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/pre-anesthesia-sedation-assessments')->assertStatus(401);
    }
}
