<?php

namespace Modules\MedicalRecordGenitalExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordGenitalExamination\Models\GenitalExamination;
use Tests\TestCase;

class GenitalExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_genital_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 21,
            'external_genitalia' => 'Normal',
            'discharge_characteristics' => 'None',
        ];

        $response = $this->postJson('/api/v1/genital-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 21)
            ->assertJsonPath('data.external_genitalia', 'Normal');

        $this->assertDatabaseHas('genital_examinations', ['visit_id' => 21, 'external_genitalia' => 'Normal']);
    }

    public function test_it_lists_genital_examinations(): void
    {
        $this->actingUser();
        GenitalExamination::factory()->count(2)->create(['visit_id' => 21]);

        $response = $this->getJson('/api/v1/genital-examinations?visit_id=21');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_genital_examination(): void
    {
        $this->actingUser();
        $record = GenitalExamination::factory()->create();

        $response = $this->getJson("/api/v1/genital-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_genital_examination(): void
    {
        $this->actingUser();
        $record = GenitalExamination::factory()->create();

        $response = $this->putJson("/api/v1/genital-examinations/{$record->id}", [
            'notes' => 'Slight inflammation',
        ]);

        $response->assertOk()->assertJsonPath('data.notes', 'Slight inflammation');
    }

    public function test_it_deletes_a_genital_examination(): void
    {
        $this->actingUser();
        $record = GenitalExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/genital-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('genital_examinations', ['id' => $record->id]);
    }
}
