<?php

namespace Modules\MedicalRecordMmpiTest\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordMmpiTest\Models\MmpiTest;
use Tests\TestCase;

class MmpiTestControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_mmpi_test(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/mmpi-tests', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'test_date' => '2026-08-13 11:00:00',
            'validity_scale_l' => 50,
            'validity_scale_f' => 55,
            'validity_scale_k' => 52,
            'clinical_scales_summary' => ['Hs' => 50, 'D' => 52],
            'interpretation' => 'Normal profile',
        ]);

        $response->assertCreated()->assertJsonPath('data.interpretation', 'Normal profile');
        $this->assertDatabaseHas('mmpi_tests', ['patient_id' => $patient->id]);
    }

    public function test_it_lists_mmpi_tests(): void
    {
        $this->actingUser();
        $test = MmpiTest::factory()->create();

        $response = $this->getJson('/api/v1/mmpi-tests');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($test->id, $response->json('data.0.id'));
    }

    public function test_it_shows_an_mmpi_test(): void
    {
        $this->actingUser();
        $test = MmpiTest::factory()->create();

        $response = $this->getJson("/api/v1/mmpi-tests/{$test->id}");

        $response->assertOk()->assertJsonPath('data.id', $test->id);
    }

    public function test_it_updates_an_mmpi_test(): void
    {
        $this->actingUser();
        $test = MmpiTest::factory()->create();

        $response = $this->putJson("/api/v1/mmpi-tests/{$test->id}", [
            'patient_id' => $test->patient_id,
            'visit_id' => $test->visit_id,
            'test_date' => $test->test_date->toDateTimeString(),
            'conclusion' => 'Updated conclusion',
        ]);

        $response->assertOk()->assertJsonPath('data.conclusion', 'Updated conclusion');
    }

    public function test_it_deletes_an_mmpi_test(): void
    {
        $this->actingUser();
        $test = MmpiTest::factory()->create();

        $response = $this->deleteJson("/api/v1/mmpi-tests/{$test->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('mmpi_tests', ['id' => $test->id]);
    }
}
