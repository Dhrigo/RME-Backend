<?php

namespace Modules\PendaftaranBedQueue\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranBedQueue\Models\BedQueue;
use Tests\TestCase;

class BedQueueControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_bed_queue_entry(): void
    {
        $this->actingUser();
        $bed = Bed::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/bed-queues', [
            'bed_id' => $bed->id,
            'patient_id' => $patient->id,
            'queue_number' => 2,
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.status', 'waiting');
    }

    public function test_it_lists_queues_filtered_by_bed(): void
    {
        $this->actingUser();
        $bed = Bed::factory()->create();
        BedQueue::factory()->count(2)->create(['bed_id' => $bed->id]);
        BedQueue::factory()->create();

        $response = $this->getJson("/api/v1/bed-queues?bed_id={$bed->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_queue_status(): void
    {
        $this->actingUser();
        $queue = BedQueue::factory()->create(['status' => 'waiting']);

        $response = $this->putJson("/api/v1/bed-queues/{$queue->id}", ['status' => 'assigned']);

        $response->assertOk()->assertJsonPath('data.status', 'assigned');
    }

    public function test_guest_cannot_access_bed_queues(): void
    {
        $this->getJson('/api/v1/bed-queues')->assertStatus(401);
    }
}
