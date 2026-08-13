<?php

namespace Modules\LayananLabExaminationResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabExaminationResult\Models\LabExaminationResult;
use Tests\TestCase;

class LabExaminationResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_exam_results(): void
    {
        $this->actingUser();
        LabExaminationResult::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-examination-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_exam_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-examination-results', [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory()->create()->id,
            'parameter_name' => 'Test Parameter_name',
            'result_value' => 'Test Result_value',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_examination_results', 1);
    }

}
