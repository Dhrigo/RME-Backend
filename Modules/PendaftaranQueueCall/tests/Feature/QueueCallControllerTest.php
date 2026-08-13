<?php

namespace Modules\PendaftaranQueueCall\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranQueueCall\Models\QueueCall;
use Modules\PendaftaranWardQueue\Models\WardQueue;
use Tests\TestCase;

class QueueCallControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_queue_call(): void
    {
        $user = $this->actingUser();
        $wardQueue = WardQueue::factory()->create();

        $response = $this->postJson('/api/v1/queue-calls', [
            'ward_queue_id' => $wardQueue->id,
            'counter' => 'Loket 1',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.counter', 'Loket 1');
        $response->assertJsonPath('data.called_by', $user->id);
    }

    public function test_it_lists_calls_filtered_by_ward_queue(): void
    {
        $this->actingUser();
        $wardQueue = WardQueue::factory()->create();
        QueueCall::factory()->count(2)->create(['ward_queue_id' => $wardQueue->id]);
        QueueCall::factory()->create();

        $response = $this->getJson("/api/v1/queue-calls?ward_queue_id={$wardQueue->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_has_no_update_or_delete_route(): void
    {
        $this->actingUser();
        $call = QueueCall::factory()->create();

        $this->putJson("/api/v1/queue-calls/{$call->id}", ['counter' => '9'])->assertStatus(405);
        $this->deleteJson("/api/v1/queue-calls/{$call->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_queue_calls(): void
    {
        $this->getJson('/api/v1/queue-calls')->assertStatus(401);
    }
}
