<?php

namespace Modules\MedicalRecordDentalExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordDentalExamination\Models\DentalExamination;
use Tests\TestCase;

class DentalExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_dental_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 22,
            'decayed_teeth_count' => 3,
            'missing_teeth_count' => 1,
            'filled_teeth_count' => 2,
            'occlusion_status' => 'Class I Malocclusion',
        ];

        $response = $this->postJson('/api/v1/dental-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 22)
            ->assertJsonPath('data.decayed_teeth_count', 3);

        $this->assertDatabaseHas('dental_examinations', ['visit_id' => 22, 'decayed_teeth_count' => 3]);
    }

    public function test_it_lists_dental_examinations(): void
    {
        $this->actingUser();
        DentalExamination::factory()->count(2)->create(['visit_id' => 22]);

        $response = $this->getJson('/api/v1/dental-examinations?visit_id=22');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_dental_examination(): void
    {
        $this->actingUser();
        $record = DentalExamination::factory()->create();

        $response = $this->getJson("/api/v1/dental-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_dental_examination(): void
    {
        $this->actingUser();
        $record = DentalExamination::factory()->create();

        $response = $this->putJson("/api/v1/dental-examinations/{$record->id}", [
            'filled_teeth_count' => 5,
        ]);

        $response->assertOk()->assertJsonPath('data.filled_teeth_count', 5);
    }

    public function test_it_deletes_a_dental_examination(): void
    {
        $this->actingUser();
        $record = DentalExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/dental-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('dental_examinations', ['id' => $record->id]);
    }
}
