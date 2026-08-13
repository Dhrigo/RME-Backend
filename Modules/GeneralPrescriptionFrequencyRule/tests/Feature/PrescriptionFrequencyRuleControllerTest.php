<?php

namespace Modules\GeneralPrescriptionFrequencyRule\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPrescriptionFrequencyRule\Models\PrescriptionFrequencyRule;
use Tests\TestCase;

class PrescriptionFrequencyRuleControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_rules(): void
    {
        $this->actingUser();
        PrescriptionFrequencyRule::factory()->count(3)->create();

        $this->getJson('/api/v1/prescription-frequency-rules')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_rule(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/prescription-frequency-rules', [
            'code' => '3x1',
            'description' => 'Tiga kali sehari',
            'times_per_day' => 3,
            'interval_hours' => 8,
        ])->assertCreated()->assertJsonPath('data.code', '3x1');

        $this->assertDatabaseHas('prescription_frequency_rules', ['code' => '3x1']);
    }

    public function test_it_rejects_duplicate_code(): void
    {
        $this->actingUser();
        PrescriptionFrequencyRule::factory()->create(['code' => '2x1']);

        $this->postJson('/api/v1/prescription-frequency-rules', [
            'code' => '2x1',
            'times_per_day' => 2,
        ])->assertStatus(422);
    }

    public function test_it_updates_rule(): void
    {
        $this->actingUser();
        $rule = PrescriptionFrequencyRule::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/prescription-frequency-rules/{$rule->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_rule(): void
    {
        $this->actingUser();
        $rule = PrescriptionFrequencyRule::factory()->create();

        $this->deleteJson("/api/v1/prescription-frequency-rules/{$rule->id}")->assertStatus(204);
        $this->assertDatabaseMissing('prescription_frequency_rules', ['id' => $rule->id]);
    }
}
