<?php

namespace Modules\GeneralBankAccount\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralBankAccount\Models\BankAccount;

class BankAccountController extends Controller
{
    public function index()
    {
        return BankAccount::query()->orderBy('bank_name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bank_name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255', 'unique:bank_accounts,account_number'],
            'account_holder' => ['required', 'string', 'max:255'],
            'account_type' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(BankAccount::create($data)->refresh(), 201);
    }

    public function show(BankAccount $bankAccount): BankAccount
    {
        return $bankAccount;
    }

    public function update(Request $request, BankAccount $bankAccount): BankAccount
    {
        $data = $request->validate([
            'bank_name' => ['sometimes', 'string', 'max:255'],
            'account_number' => ['sometimes', 'string', 'max:255', Rule::unique('bank_accounts', 'account_number')->ignore($bankAccount->id)],
            'account_holder' => ['sometimes', 'string', 'max:255'],
            'account_type' => ['sometimes', 'nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $bankAccount->update($data);

        return $bankAccount;
    }

    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();

        return response()->json(null, 204);
    }
}
