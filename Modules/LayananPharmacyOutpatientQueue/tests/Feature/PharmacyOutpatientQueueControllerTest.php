<?php

namespace Modules\LayananPharmacyOutpatientQueue\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPharmacyOutpatientQueue\Models\PharmacyOutpatientQueue;
use Tests\TestCase;

class PharmacyOutpatientQueueControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_queues(): void
    {
        $this->actingUser();
        PharmacyOutpatientQueue::factory()->count(3)->create();

        $this->getJson('/api/v1/pharmacy-outpatient-queues')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_queue(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pharmacy-outpatient-queues', [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory()->create()->id,
            'queue_number' => 'Test Queue_number',
            'status' => 'waiting',
        ])->assertCreated();

        $this->assertDatabaseCount('pharmacy_outpatient_queues', 1);
    }

    public function test_it_shows_queue(): void
    {
        $this->actingUser();
        $queue = PharmacyOutpatientQueue::factory()->create();

        $this->getJson("/api/v1/pharmacy-outpatient-queues/{$queue->id}")->assertOk()->assertJsonPath('data.id', $queue->id);
    }

}
