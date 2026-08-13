<?php

namespace Modules\LayananBirthRecord\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananBirthRecord\Models\BirthRecord;
use Tests\TestCase;

class BirthRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_birth_records(): void
    {
        $this->actingUser();
        BirthRecord::factory()->count(3)->create();

        $this->getJson('/api/v1/birth-records')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_birth_record(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/birth-records', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'mother_patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'birth_date' => '2026-01-01 08:00:00',
            'delivery_method' => 'normal',
        ])->assertCreated();

        $this->assertDatabaseCount('birth_records', 1);
    }

    public function test_it_shows_birth_record(): void
    {
        $this->actingUser();
        $birth_record = BirthRecord::factory()->create();

        $this->getJson("/api/v1/birth-records/{$birth_record->id}")->assertOk()->assertJsonPath('data.id', $birth_record->id);
    }

}
