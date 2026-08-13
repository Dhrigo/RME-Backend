<?php

namespace Modules\MedicalRecordDoctorProcedureConsent\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent;
use Tests\TestCase;

class DoctorProcedureConsentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/doctor-procedure-consents', [
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'procedure_name' => fake()->words(3,true),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('doctor_procedure_consents', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        DoctorProcedureConsent::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/doctor-procedure-consents');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/doctor-procedure-consents')->assertStatus(401);
    }
}
