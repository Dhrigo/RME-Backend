<?php

namespace Modules\MedicalRecordFluidFinalBalance\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFluidFinalBalance\Models\FluidFinalBalance;
use Tests\TestCase;

class FluidFinalBalanceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $visitId = Visit::factory()->create();
        $recordedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/fluid-final-balances', [
            'visit_id' => $visitId->id,
            'period_date' => now()->toDateTimeString(),
            'total_intake_ml' => 12.5,
            'total_output_ml' => 12.5,
            'recorded_by' => $recordedBy->id,
            'recorded_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('fluid_final_balances', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        FluidFinalBalance::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/fluid-final-balances');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = FluidFinalBalance::factory()->create();

        $this->getJson("/api/v1/fluid-final-balances/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = FluidFinalBalance::factory()->create();

        $this->deleteJson("/api/v1/fluid-final-balances/{$record->id}")->assertStatus(204);
    }
}
