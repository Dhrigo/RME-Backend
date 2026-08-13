<?php

namespace Modules\InventoryStockOpname\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryStockOpname\Models\StockOpname;
use Tests\TestCase;

class InventoryStockOpnameControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_stock_opnames(): void
    {
        $this->actingUser();
        StockOpname::factory()->count(3)->create();

        $this->getJson('/api/v1/inventorystockopnames')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_stock_opname_in_progress(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/inventorystockopnames', [
            'ward_id' => $ward->id,
            'opname_date' => now()->toDateString(),
            'conducted_by' => $employee->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
        $this->assertDatabaseHas('stock_opnames', ['ward_id' => $ward->id, 'conducted_by' => $employee->id]);
    }

    public function test_it_rejects_missing_conducted_by(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/inventorystockopnames', ['ward_id' => $ward->id, 'opname_date' => now()->toDateString()])
            ->assertStatus(422);
    }

    public function test_it_completes_stock_opname(): void
    {
        $this->actingUser();
        $opname = StockOpname::factory()->create(['status' => 'in_progress']);

        $this->putJson("/api/v1/inventorystockopnames/{$opname->id}", ['status' => 'completed'])
            ->assertOk()
            ->assertJsonPath('data.status', 'completed');
    }

    public function test_guest_cannot_access_stock_opnames(): void
    {
        $this->getJson('/api/v1/inventorystockopnames')->assertStatus(401);
    }
}
