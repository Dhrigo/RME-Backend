<?php

namespace Modules\LayananLabOrder\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class LabOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_lab_order_with_auto_generated_number(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $doctor = Employee::factory()->create();

        $response = $this->postJson('/api/v1/lab-orders', [
            'visit_id' => $visit->id,
            'ordered_by' => $doctor->id,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('LAB-'.now()->format('Y').'-', $response->json('data.order_number'));
    }

    public function test_it_transitions_status(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create();

        $this->putJson("/api/v1/lab-orders/{$order->id}", ['status' => 'completed'])
            ->assertOk()
            ->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create();

        $this->putJson("/api/v1/lab-orders/{$order->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }
}
