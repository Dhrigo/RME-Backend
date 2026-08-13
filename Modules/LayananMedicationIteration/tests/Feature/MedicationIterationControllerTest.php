<?php

namespace Modules\LayananMedicationIteration\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananMedicationIteration\Models\MedicationIteration;
use Tests\TestCase;

class MedicationIterationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_iterations(): void
    {
        $this->actingUser();
        MedicationIteration::factory()->count(3)->create();

        $this->getJson('/api/v1/medication-iterations')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_iteration(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/medication-iterations', [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory()->create()->id,
            'iteration_number' => 5,
            'quantity' => 5,
            'status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseCount('medication_iterations', 1);
    }

    public function test_it_shows_iteration(): void
    {
        $this->actingUser();
        $iteration = MedicationIteration::factory()->create();

        $this->getJson("/api/v1/medication-iterations/{$iteration->id}")->assertOk()->assertJsonPath('data.id', $iteration->id);
    }

}
