<?php

namespace Modules\PendaftaranAccidentRecord\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranAccidentRecord\Models\AccidentRecord;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class AccidentRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_accident_records(): void
    {
        AccidentRecord::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/accidentrecords');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_accident_record(): void
    {
        $visit = Visit::factory()->create();

        $data = [
            'visit_id' => $visit->id,
            'accident_type' => 'Traffic',
            'accident_at' => now()->toDateTimeString(),
            'location' => 'Street A',
            'police_report_number' => 'POL-123',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/accidentrecords', $data);

        $response->assertCreated()
            ->assertJsonPath('data.accident_type', 'Traffic');

        $this->assertDatabaseHas('accident_records', $data);
    }

    public function test_can_show_accident_record(): void
    {
        $accident = AccidentRecord::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/accidentrecords/{$accident->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $accident->id);
    }
}
