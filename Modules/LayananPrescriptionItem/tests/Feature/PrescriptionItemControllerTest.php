<?php

namespace Modules\LayananPrescriptionItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Tests\TestCase;

class PrescriptionItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_adds_drug_line_to_prescription(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();

        $this->postJson('/api/v1/prescription-items', [
            'prescription_id' => $prescription->id,
            'drug_name' => 'Amoxicillin 500mg',
            'dosage' => '1 kapsul',
            'frequency' => '3x sehari',
        ])->assertCreated()->assertJsonPath('data.drug_name', 'Amoxicillin 500mg');
    }

    public function test_it_lists_items_filtered_by_prescription(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();
        PrescriptionItem::factory()->count(2)->create(['prescription_id' => $prescription->id]);
        PrescriptionItem::factory()->create();

        $this->getJson("/api/v1/prescription-items?prescription_id={$prescription->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }
}
