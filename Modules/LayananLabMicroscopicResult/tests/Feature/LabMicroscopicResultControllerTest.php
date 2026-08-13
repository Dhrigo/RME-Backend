<?php

namespace Modules\LayananLabMicroscopicResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabMicroscopicResult\Models\LabMicroscopicResult;
use Tests\TestCase;

class LabMicroscopicResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_microscopic_results(): void
    {
        $this->actingUser();
        LabMicroscopicResult::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-microscopic-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_microscopic_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-microscopic-results', [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory()->create()->id,
            'specimen_type' => 'Test Specimen_type',
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_microscopic_results', 1);
    }

}
