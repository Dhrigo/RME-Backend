<?php

namespace Modules\PendaftaranVisitDateChange\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitDateChange\Models\VisitDateChange;
use Tests\TestCase;

class VisitDateChangeControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_visit_date_changes(): void
    {
        VisitDateChange::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/visitdatechanges');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_visit_date_change(): void
    {
        $visit = Visit::factory()->create();

        $data = [
            'visit_id' => $visit->id,
            'old_date' => now()->format('Y-m-d'),
            'new_date' => now()->addDays(2)->format('Y-m-d'),
            'reason' => 'Patient request',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/visitdatechanges', $data);

        $response->assertCreated()
            ->assertJsonPath('data.reason', 'Patient request');

        $this->assertDatabaseHas('visit_date_changes', array_merge($data, [
            'changed_by' => $this->user->id,
        ]));
    }

    public function test_can_show_visit_date_change(): void
    {
        $change = VisitDateChange::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/visitdatechanges/{$change->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $change->id);
    }
}
