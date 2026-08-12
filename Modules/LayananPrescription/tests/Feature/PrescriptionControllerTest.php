<?php

namespace Modules\LayananPrescription\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class PrescriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_prescription_with_auto_generated_number(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $doctor = Employee::factory()->create();

        $response = $this->postJson('/api/v1/prescriptions', [
            'visit_id' => $visit->id,
            'prescribed_by' => $doctor->id,
            'has_drug_allergy' => true,
        ]);

        $response->assertCreated()->assertJsonPath('data.has_drug_allergy', true);
        $this->assertStringStartsWith('RX-'.now()->format('Y').'-', $response->json('data.prescription_number'));
        $this->assertDatabaseHas('prescriptions', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_shows_prescription_with_items(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();
        $prescription->items()->create([
            'drug_name' => 'Paracetamol 500mg',
            'dosage' => '1 tablet',
            'frequency' => '3x sehari',
        ]);

        $response = $this->getJson("/api/v1/prescriptions/{$prescription->id}");

        $response->assertOk()->assertJsonPath('data.items.0.drug_name', 'Paracetamol 500mg');
    }

    public function test_guest_cannot_access_prescriptions(): void
    {
        $this->getJson('/api/v1/prescriptions')->assertStatus(401);
    }
}
