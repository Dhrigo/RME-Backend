<?php

namespace Modules\LayananLabOrderItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabOrderItem\Models\LabOrderItem;
use Tests\TestCase;

class LabOrderItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_lab_order_items(): void
    {
        $this->actingUser();
        LabOrderItem::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-order-items')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_lab_order_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-order-items', [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory()->create()->id,
            'examination_name' => 'Test Examination_name',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_order_items', 1);
    }

}
