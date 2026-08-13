<?php

namespace Modules\PembayaranDoctorDiscount\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranDiscount\Models\Discount;
use Modules\PembayaranDoctorDiscount\Models\DoctorDiscount;
use Tests\TestCase;

class DoctorDiscountControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_doctor_discounts(): void
    {
        $this->actingUser();
        DoctorDiscount::factory()->count(3)->create();

        $this->getJson('/api/v1/doctor-discounts')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_doctor_discount(): void
    {
        $this->actingUser();
        $discount = Discount::factory()->create();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/doctor-discounts', [
            'discount_id' => $discount->id,
            'employee_id' => $employee->id,
            'percentage' => 15,
        ])->assertCreated()->assertJsonPath('percentage', '15.00');

        $this->assertDatabaseHas('doctor_discounts', ['discount_id' => $discount->id, 'employee_id' => $employee->id]);
    }

    public function test_it_rejects_percentage_over_100(): void
    {
        $this->actingUser();
        $discount = Discount::factory()->create();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/doctor-discounts', [
            'discount_id' => $discount->id,
            'employee_id' => $employee->id,
            'percentage' => 150,
        ])->assertStatus(422);
    }

    public function test_it_updates_doctor_discount(): void
    {
        $this->actingUser();
        $doctorDiscount = DoctorDiscount::factory()->create(['percentage' => 10]);

        $this->putJson("/api/v1/doctor-discounts/{$doctorDiscount->id}", ['percentage' => 25])
            ->assertOk()
            ->assertJsonPath('percentage', '25.00');
    }

    public function test_it_deletes_doctor_discount(): void
    {
        $this->actingUser();
        $doctorDiscount = DoctorDiscount::factory()->create();

        $this->deleteJson("/api/v1/doctor-discounts/{$doctorDiscount->id}")->assertStatus(204);
        $this->assertDatabaseMissing('doctor_discounts', ['id' => $doctorDiscount->id]);
    }

    public function test_guest_cannot_access_doctor_discounts(): void
    {
        $this->getJson('/api/v1/doctor-discounts')->assertStatus(401);
    }
}
