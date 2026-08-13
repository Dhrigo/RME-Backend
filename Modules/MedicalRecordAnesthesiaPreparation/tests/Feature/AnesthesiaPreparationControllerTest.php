<?php

namespace Modules\MedicalRecordAnesthesiaPreparation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordAnesthesiaPreparation\Models\AnesthesiaPreparation;
use Tests\TestCase;

class AnesthesiaPreparationControllerTest extends TestCase
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
        $preparedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/anesthesia-preparations', [
            'visit_id' => $visit->id,
            'prepared_by' => $preparedBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('anesthesia_preparations', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        AnesthesiaPreparation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/anesthesia-preparations');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/anesthesia-preparations')->assertStatus(401);
    }
}
