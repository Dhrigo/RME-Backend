<?php

namespace Modules\PendaftaranVisitCancellation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitCancellation\Models\VisitCancellation;
use Tests\TestCase;

class VisitCancellationControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_visit_cancellations(): void
    {
        VisitCancellation::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/visitcancellations');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_visit_cancellation(): void
    {
        $visit = Visit::factory()->create();

        $data = [
            'visit_id' => $visit->id,
            'reason' => 'Patient left',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/visitcancellations', $data);

        $response->assertCreated()
            ->assertJsonPath('data.reason', 'Patient left');

        $this->assertDatabaseHas('visit_cancellations', [
            'visit_id' => $visit->id,
            'reason' => 'Patient left',
            'cancelled_by' => $this->user->id,
        ]);
    }

    public function test_can_show_visit_cancellation(): void
    {
        $cancellation = VisitCancellation::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/visitcancellations/{$cancellation->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $cancellation->id);
    }
}
