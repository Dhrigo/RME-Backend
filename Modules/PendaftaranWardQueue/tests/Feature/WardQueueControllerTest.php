<?php

namespace Modules\PendaftaranWardQueue\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranWardQueue\Models\WardQueue;
use Tests\TestCase;

class WardQueueControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_ward_queue_entry(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $response = $this->postJson('/api/v1/ward-queues', [
            'ward_id' => $ward->id,
            'queue_number' => 5,
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.status', 'waiting');
    }

    public function test_it_lists_queues_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        WardQueue::factory()->count(2)->create(['ward_id' => $ward->id]);
        WardQueue::factory()->create();

        $response = $this->getJson("/api/v1/ward-queues?ward_id={$ward->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_status_to_called_and_stamps_called_at(): void
    {
        $this->actingUser();
        $queue = WardQueue::factory()->create(['status' => 'waiting']);

        $response = $this->putJson("/api/v1/ward-queues/{$queue->id}", ['status' => 'called']);

        $response->assertOk()->assertJsonPath('data.status', 'called');
        $this->assertNotNull($response->json('data.called_at'));
    }

    public function test_guest_cannot_access_ward_queues(): void
    {
        $this->getJson('/api/v1/ward-queues')->assertStatus(401);
    }
}
