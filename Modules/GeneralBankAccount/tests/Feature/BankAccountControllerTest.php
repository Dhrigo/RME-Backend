<?php

namespace Modules\GeneralBankAccount\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralBankAccount\Models\BankAccount;
use Tests\TestCase;

class BankAccountControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_bank_accounts(): void
    {
        $this->actingUser();
        BankAccount::factory()->count(3)->create();

        $this->getJson('/api/v1/bank-accounts')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_bank_account(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/bank-accounts', [
            'bank_name' => 'Bank Mandiri',
            'account_number' => '1234567890',
            'account_holder' => 'RSUD Sejahtera',
        ])
            ->assertCreated()
            ->assertJsonPath('bank_name', 'Bank Mandiri');

        $this->assertDatabaseHas('bank_accounts', ['account_number' => '1234567890']);
    }

    public function test_it_rejects_duplicate_account_number(): void
    {
        $this->actingUser();
        BankAccount::factory()->create(['account_number' => '1234567890']);

        $this->postJson('/api/v1/bank-accounts', [
            'bank_name' => 'Bank Mandiri',
            'account_number' => '1234567890',
            'account_holder' => 'RSUD Sejahtera',
        ])->assertStatus(422);
    }

    public function test_it_deletes_bank_account(): void
    {
        $this->actingUser();
        $bankAccount = BankAccount::factory()->create();

        $this->deleteJson("/api/v1/bank-accounts/{$bankAccount->id}")->assertStatus(204);
        $this->assertDatabaseMissing('bank_accounts', ['id' => $bankAccount->id]);
    }
}
