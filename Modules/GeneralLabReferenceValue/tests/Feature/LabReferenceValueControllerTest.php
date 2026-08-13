<?php

namespace Modules\GeneralLabReferenceValue\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralLabReferenceValue\Models\LabReferenceValue;
use Modules\GeneralLabServiceParameter\Models\LabServiceParameter;
use Tests\TestCase;

class LabReferenceValueControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_lab_reference_values(): void
    {
        $this->actingUser();
        LabReferenceValue::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-reference-values')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_lab_reference_value(): void
    {
        $this->actingUser();
        $parameter = LabServiceParameter::factory()->create();

        $this->postJson('/api/v1/lab-reference-values', [
            'lab_service_parameter_id' => $parameter->id,
            'gender' => 'male',
            'min_value' => 13.5,
            'max_value' => 17.5,
            'unit' => 'g/dL',
        ])
            ->assertCreated()
            ->assertJsonPath('unit', 'g/dL');

        $this->assertDatabaseHas('lab_reference_values', ['lab_service_parameter_id' => $parameter->id, 'gender' => 'male']);
    }

    public function test_it_rejects_invalid_range(): void
    {
        $this->actingUser();
        $parameter = LabServiceParameter::factory()->create();

        $this->postJson('/api/v1/lab-reference-values', [
            'lab_service_parameter_id' => $parameter->id,
            'min_value' => 20,
            'max_value' => 10,
        ])->assertStatus(422);
    }

    public function test_it_deletes_lab_reference_value(): void
    {
        $this->actingUser();
        $value = LabReferenceValue::factory()->create();

        $this->deleteJson("/api/v1/lab-reference-values/{$value->id}")->assertStatus(204);
        $this->assertDatabaseMissing('lab_reference_values', ['id' => $value->id]);
    }
}
