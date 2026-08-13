<?php

namespace Modules\PendaftaranPatientTransfer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'from_ward_id' => ['required', 'integer', 'exists:wards,id'],
            'to_ward_id' => ['required', 'integer', 'exists:wards,id', 'different:from_ward_id'],
            'transferred_at' => ['nullable', 'date'],
            'reason' => ['nullable', 'string'],
        ];
    }
}
