<?php

namespace Modules\MedicalRecordBloodTransfusion\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\KemkesBloodType\Models\BloodType;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class BloodTransfusionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_starts_a_transfusion(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $bloodType = BloodType::factory()->create();
        $administeredBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/blood-transfusions', [
            'visit_id' => $visit->id,
            'blood_type_id' => $bloodType->id,
            'administered_by' => $administeredBy->id,
            'volume_ml' => 350,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
        $this->assertDatabaseHas('blood_transfusions', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_transfusions_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        BloodTransfusion::factory()->count(2)->create(['visit_id' => $visit->id]);
        BloodTransfusion::factory()->create();

        $response = $this->getJson("/api/v1/blood-transfusions?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_completes_a_transfusion(): void
    {
        $this->actingUser();
        $transfusion = BloodTransfusion::factory()->create(['status' => 'in_progress']);

        $response = $this->putJson("/api/v1/blood-transfusions/{$transfusion->id}", [
            'status' => 'completed',
            'ended_at' => now()->toIso8601String(),
        ]);

        $response->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_guest_cannot_access_blood_transfusions(): void
    {
        $this->getJson('/api/v1/blood-transfusions')->assertStatus(401);
    }
}
