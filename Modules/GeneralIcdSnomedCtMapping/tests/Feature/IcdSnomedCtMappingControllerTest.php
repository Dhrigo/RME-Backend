<?php

namespace Modules\GeneralIcdSnomedCtMapping\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralIcdSnomedCtMapping\Models\IcdSnomedCtMapping;
use Tests\TestCase;

class IcdSnomedCtMappingControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_mappings(): void
    {
        $this->actingUser();
        IcdSnomedCtMapping::factory()->count(3)->create();

        $this->getJson('/api/v1/icd-snomed-ct-mappings')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_mapping(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/icd-snomed-ct-mappings', [
            'icd_code' => 'A00.0',
            'snomed_code' => '63650001',
        ])
            ->assertCreated()
            ->assertJsonPath('icd_code', 'A00.0');

        $this->assertDatabaseHas('icd_snomed_ct_mappings', ['icd_code' => 'A00.0', 'snomed_code' => '63650001']);
    }

    public function test_it_rejects_duplicate_pair(): void
    {
        $this->actingUser();
        IcdSnomedCtMapping::factory()->create(['icd_code' => 'A00.0', 'snomed_code' => '63650001']);

        $this->postJson('/api/v1/icd-snomed-ct-mappings', ['icd_code' => 'A00.0', 'snomed_code' => '63650001'])->assertStatus(422);
    }

    public function test_it_deletes_mapping(): void
    {
        $this->actingUser();
        $mapping = IcdSnomedCtMapping::factory()->create();

        $this->deleteJson("/api/v1/icd-snomed-ct-mappings/{$mapping->id}")->assertStatus(204);
        $this->assertDatabaseMissing('icd_snomed_ct_mappings', ['id' => $mapping->id]);
    }
}
