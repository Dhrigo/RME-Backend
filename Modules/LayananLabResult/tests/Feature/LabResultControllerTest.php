<?php

namespace Modules\LayananLabResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabOrder\Models\LabOrder;
use Tests\TestCase;

class LabResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_result(): void
    {
        $user = $this->actingUser();
        $order = LabOrder::factory()->create();

        $response = $this->postJson('/api/v1/lab-results', [
            'lab_order_id' => $order->id,
            'test_name' => 'Hemoglobin',
            'result_value' => '13.5',
            'unit' => 'g/dL',
        ]);

        $response->assertCreated()->assertJsonPath('data.test_name', 'Hemoglobin');
        $this->assertDatabaseHas('lab_results', ['lab_order_id' => $order->id, 'recorded_by' => $user->id]);
    }

    public function test_order_shows_its_results(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create();
        $order->results()->create([
            'test_name' => 'Leukosit',
            'result_value' => '7.2',
            'recorded_at' => now(),
        ]);

        $this->getJson("/api/v1/lab-orders/{$order->id}")
            ->assertOk()
            ->assertJsonPath('data.results.0.test_name', 'Leukosit');
    }
}
