<?php

namespace Modules\LayananLabMicroscopicResultItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabMicroscopicResultItem\Models\LabMicroscopicResultItem;
use Tests\TestCase;

class LabMicroscopicResultItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_microscopic_items(): void
    {
        $this->actingUser();
        LabMicroscopicResultItem::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-microscopic-result-items')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_microscopic_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-microscopic-result-items', [
            'lab_microscopic_result_id' => \Modules\LayananLabMicroscopicResult\Models\LabMicroscopicResult::factory()->create()->id,
            'parameter_name' => 'Test Parameter_name',
            'value' => 'Test Value',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_microscopic_result_items', 1);
    }

}
