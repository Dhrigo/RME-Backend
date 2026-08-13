<?php

namespace Modules\GeneralPrescriptionFrequencyRuleCategory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPrescriptionFrequencyRule\Models\PrescriptionFrequencyRule;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Models\PrescriptionFrequencyRuleCategory;
use Tests\TestCase;

class PrescriptionFrequencyRuleCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_categories(): void
    {
        $this->actingUser();
        PrescriptionFrequencyRuleCategory::factory()->count(3)->create();

        $this->getJson('/api/v1/prescription-frequency-rule-categories')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_category(): void
    {
        $this->actingUser();
        $rule = PrescriptionFrequencyRule::factory()->create();

        $this->postJson('/api/v1/prescription-frequency-rule-categories', [
            'prescription_frequency_rule_id' => $rule->id,
            'category_name' => 'Oral',
        ])->assertCreated()->assertJsonPath('data.category_name', 'Oral');

        $this->assertDatabaseHas('prescription_frequency_rule_categories', ['prescription_frequency_rule_id' => $rule->id, 'category_name' => 'Oral']);
    }

    public function test_it_rejects_unknown_rule(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/prescription-frequency-rule-categories', [
            'prescription_frequency_rule_id' => 99999,
            'category_name' => 'Oral',
        ])->assertStatus(422);
    }

    public function test_it_updates_category(): void
    {
        $this->actingUser();
        $category = PrescriptionFrequencyRuleCategory::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/prescription-frequency-rule-categories/{$category->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_category(): void
    {
        $this->actingUser();
        $category = PrescriptionFrequencyRuleCategory::factory()->create();

        $this->deleteJson("/api/v1/prescription-frequency-rule-categories/{$category->id}")->assertStatus(204);
        $this->assertDatabaseMissing('prescription_frequency_rule_categories', ['id' => $category->id]);
    }
}
