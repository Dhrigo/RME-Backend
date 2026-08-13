<?php

namespace Modules\PembayaranTransfer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_id' => ['required', 'integer', 'exists:payments,id'],
            'transfer_reference_number' => ['required', 'string', 'max:255', 'unique:bank_transfers,transfer_reference_number'],
            'source_bank_name' => ['required', 'string', 'max:255'],
            'destination_account_number' => ['required', 'string', 'max:255'],
            'destination_account_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'transferred_at' => ['nullable', 'date'],
            'proof_file_path' => ['nullable', 'string', 'max:255'],
        ];
    }
}
