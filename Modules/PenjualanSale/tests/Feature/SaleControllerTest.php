<?php

namespace Modules\PenjualanSale\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PenjualanSale\Models\Sale;
use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_walkin_sale_with_auto_generated_number(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/sales', [
            'sold_by' => $employee->id,
            'total_amount' => 150000,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('SAL-'.now()->format('Y').'-', $response->json('data.sale_number'));
        $this->assertNull($response->json('data.patient_id'));
    }

    public function test_it_records_a_sale_for_a_patient(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/sales', [
            'patient_id' => $patient->id,
            'sold_by' => $employee->id,
            'total_amount' => 75000,
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.patient_id', $patient->id);
    }

    public function test_it_lists_sales_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        Sale::factory()->count(2)->create(['patient_id' => $patient->id]);
        Sale::factory()->create();

        $response = $this->getJson("/api/v1/sales?patient_id={$patient->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_sale_status(): void
    {
        $this->actingUser();
        $sale = Sale::factory()->create(['status' => 'completed']);

        $response = $this->putJson("/api/v1/sales/{$sale->id}", ['status' => 'void']);

        $response->assertOk()->assertJsonPath('data.status', 'void');
    }

    public function test_guest_cannot_access_sales(): void
    {
        $this->getJson('/api/v1/sales')->assertStatus(401);
    }
}
