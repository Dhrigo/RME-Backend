<?php

namespace Modules\PembayaranCashier\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranCashier\Models\Cashier;
use Tests\TestCase;

class CashierControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_cashiers(): void
    {
        $this->actingUser();
        Cashier::factory()->count(3)->create();

        $this->getJson('/api/v1/cashiers')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_cashier(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/cashiers', [
            'employee_id' => $employee->id,
            'cashier_code' => 'KSR-0001',
            'shift' => 'pagi',
        ])->assertCreated()->assertJsonPath('cashier_code', 'KSR-0001');

        $this->assertDatabaseHas('cashiers', ['cashier_code' => 'KSR-0001', 'employee_id' => $employee->id]);
    }

    public function test_it_rejects_duplicate_cashier_code(): void
    {
        $this->actingUser();
        Cashier::factory()->create(['cashier_code' => 'KSR-0001']);
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/cashiers', [
            'employee_id' => $employee->id,
            'cashier_code' => 'KSR-0001',
            'shift' => 'siang',
        ])->assertStatus(422);
    }

    public function test_it_updates_cashier(): void
    {
        $this->actingUser();
        $cashier = Cashier::factory()->create(['shift' => 'pagi']);

        $this->putJson("/api/v1/cashiers/{$cashier->id}", ['shift' => 'malam'])
            ->assertOk()
            ->assertJsonPath('shift', 'malam');
    }

    public function test_it_deletes_cashier(): void
    {
        $this->actingUser();
        $cashier = Cashier::factory()->create();

        $this->deleteJson("/api/v1/cashiers/{$cashier->id}")->assertStatus(204);
        $this->assertDatabaseMissing('cashiers', ['id' => $cashier->id]);
    }

    public function test_guest_cannot_access_cashiers(): void
    {
        $this->getJson('/api/v1/cashiers')->assertStatus(401);
    }
}
