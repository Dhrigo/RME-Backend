<?php

namespace Modules\MedicalRecordProcedureSurgery\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordProcedureSurgery\Models\ProcedureSurgery;
use Tests\TestCase;

class ProcedureSurgeryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_procedure_surgery_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 3,
            'procedure_id' => 101,
            'surgery_name' => 'Excision of Lesion',
            'surgery_type' => 'Minor',
            'anesthesia_type' => 'Local',
        ];

        $response = $this->postJson('/api/v1/procedure-surgeries', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.surgery_name', 'Excision of Lesion');

        $this->assertDatabaseHas('procedure_surgeries', ['visit_id' => 3, 'surgery_name' => 'Excision of Lesion']);
    }

    public function test_it_lists_procedure_surgeries(): void
    {
        $this->actingUser();
        ProcedureSurgery::factory()->count(2)->create(['visit_id' => 3]);

        $response = $this->getJson('/api/v1/procedure-surgeries?visit_id=3');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_procedure_surgery(): void
    {
        $this->actingUser();
        $record = ProcedureSurgery::factory()->create();

        $response = $this->getJson("/api/v1/procedure-surgeries/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_procedure_surgery(): void
    {
        $this->actingUser();
        $record = ProcedureSurgery::factory()->create();

        $response = $this->putJson("/api/v1/procedure-surgeries/{$record->id}", [
            'surgery_type' => 'Major',
        ]);

        $response->assertOk()->assertJsonPath('data.surgery_type', 'Major');
    }

    public function test_it_deletes_a_procedure_surgery(): void
    {
        $this->actingUser();
        $record = ProcedureSurgery::factory()->create();

        $response = $this->deleteJson("/api/v1/procedure-surgeries/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('procedure_surgeries', ['id' => $record->id]);
    }
}
