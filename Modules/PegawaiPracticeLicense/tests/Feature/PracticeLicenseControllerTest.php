<?php

namespace Modules\PegawaiPracticeLicense\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiPracticeLicense\Models\PracticeLicense;
use Tests\TestCase;

class PracticeLicenseControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_practice_license(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/practice-licenses', [
            'employee_id' => $employee->id,
            'license_type' => 'STR',
            'license_number' => 'STR-0000000001',
            'issued_at' => '2022-01-01',
            'expires_at' => '2027-01-01',
            'issuing_authority' => 'Konsil Kedokteran Indonesia',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.license_type', 'STR');
        $response->assertJsonPath('data.license_number', 'STR-0000000001');
    }

    public function test_it_rejects_duplicate_license_number(): void
    {
        $this->actingUser();
        $existing = PracticeLicense::factory()->create(['license_number' => 'SIP-1111111111']);

        $response = $this->postJson('/api/v1/practice-licenses', [
            'employee_id' => $existing->employee_id,
            'license_type' => 'SIP',
            'license_number' => 'SIP-1111111111',
        ]);

        $response->assertStatus(422);
    }

    public function test_it_rejects_expiry_before_issuance(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/practice-licenses', [
            'employee_id' => $employee->id,
            'license_type' => 'STR',
            'license_number' => 'STR-0000000099',
            'issued_at' => '2024-01-01',
            'expires_at' => '2023-01-01',
        ]);

        $response->assertStatus(422);
    }

    public function test_it_lists_licenses_filtered_by_employee(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        PracticeLicense::factory()->count(2)->create(['employee_id' => $employee->id]);
        PracticeLicense::factory()->create();

        $response = $this->getJson("/api/v1/practice-licenses?employee_id={$employee->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_expiry_and_authority(): void
    {
        $this->actingUser();
        $license = PracticeLicense::factory()->create();

        $response = $this->putJson("/api/v1/practice-licenses/{$license->id}", [
            'expires_at' => '2030-01-01',
            'issuing_authority' => 'Dinas Kesehatan',
        ]);

        $response->assertOk()->assertJsonPath('data.issuing_authority', 'Dinas Kesehatan');
    }

    public function test_guest_cannot_access_practice_licenses(): void
    {
        $this->getJson('/api/v1/practice-licenses')->assertStatus(401);
    }
}
