<?php

namespace Modules\LayananLabPcrResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabPcrResult\Models\LabPcrResult;
use Tests\TestCase;

class LabPcrResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_pcr_results(): void
    {
        $this->actingUser();
        LabPcrResult::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-pcr-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_pcr_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-pcr-results', [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory()->create()->id,
            'target_gene' => 'Test Target_gene',
            'result' => 'detected',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_pcr_results', 1);
    }

}
