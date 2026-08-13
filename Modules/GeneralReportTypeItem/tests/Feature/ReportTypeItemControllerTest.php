<?php

namespace Modules\GeneralReportTypeItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralReportType\Models\ReportType;
use Modules\GeneralReportTypeItem\Models\ReportTypeItem;
use Tests\TestCase;

class ReportTypeItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_report_type_item(): void
    {
        $this->actingUser();
        $reportType = ReportType::factory()->create();

        $response = $this->postJson('/api/v1/report-type-items', [
            'report_type_id' => $reportType->id,
            'name' => 'RL 3.1 Rawat Inap',
            'code' => 'RL-31',
            'sequence' => 1,
        ]);

        $response->assertCreated()->assertJsonPath('data.name', 'RL 3.1 Rawat Inap');
        $this->assertDatabaseHas('report_type_items', ['report_type_id' => $reportType->id, 'name' => 'RL 3.1 Rawat Inap']);
    }

    public function test_it_lists_items_filtered_by_report_type(): void
    {
        $this->actingUser();
        $reportType = ReportType::factory()->create();
        ReportTypeItem::factory()->create(['report_type_id' => $reportType->id]);
        ReportTypeItem::factory()->create();

        $response = $this->getJson("/api/v1/report-type-items?report_type_id={$reportType->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_updates_a_report_type_item(): void
    {
        $this->actingUser();
        $item = ReportTypeItem::factory()->create();

        $this->putJson("/api/v1/report-type-items/{$item->id}", ['name' => 'RL 4a Morbiditas Rawat Inap'])
            ->assertOk()
            ->assertJsonPath('data.name', 'RL 4a Morbiditas Rawat Inap');
    }

    public function test_store_requires_report_type_and_name(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/report-type-items', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['report_type_id', 'name']);
    }

    public function test_it_deletes_a_report_type_item(): void
    {
        $this->actingUser();
        $item = ReportTypeItem::factory()->create();

        $this->deleteJson("/api/v1/report-type-items/{$item->id}")->assertStatus(204);
        $this->assertDatabaseMissing('report_type_items', ['id' => $item->id]);
    }

    public function test_guest_cannot_access_report_type_items(): void
    {
        $this->getJson('/api/v1/report-type-items')->assertStatus(401);
    }
}
