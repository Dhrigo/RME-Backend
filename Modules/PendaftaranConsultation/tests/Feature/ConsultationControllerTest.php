<?php

namespace Modules\PendaftaranConsultation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ConsultationControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_consultations(): void
    {
        Consultation::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/consultations');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_consultation(): void
    {
        $visit = Visit::factory()->create();
        $reqDept = MedicalDepartment::factory()->create();
        $consDept = MedicalDepartment::factory()->create();

        $data = [
            'visit_id' => $visit->id,
            'requesting_department_id' => $reqDept->id,
            'consulted_department_id' => $consDept->id,
            'requested_at' => now()->toDateTimeString(),
            'question' => 'Consulting for surgery check',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/consultations', $data);

        $response->assertCreated()
            ->assertJsonPath('data.question', 'Consulting for surgery check');

        $this->assertDatabaseHas('consultations', $data);
    }

    public function test_can_show_consultation(): void
    {
        $consultation = Consultation::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/consultations/{$consultation->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $consultation->id);
    }
}
