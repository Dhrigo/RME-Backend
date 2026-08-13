<?php

namespace Modules\MedicalRecordTbDiseaseHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordTbDiseaseHistory\Models\TbDiseaseHistory;
use Tests\TestCase;

class TbDiseaseHistoryControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/tb-disease-histories', [
            'visit_id' => $visit->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('tb_disease_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TbDiseaseHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/tb-disease-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/tb-disease-histories')->assertStatus(401);
    }
}
