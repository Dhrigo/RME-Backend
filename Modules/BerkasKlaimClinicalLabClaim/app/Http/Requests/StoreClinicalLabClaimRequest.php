<?php

namespace Modules\BerkasKlaimClinicalLabClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicalLabClaimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'claim_file_id' => ['required', 'integer', 'exists:claim_files,id'],
            'order_id' => ['nullable', 'integer', 'exists:lab_orders,id'],
            'submitted_at' => ['nullable', 'date'],
        ];
    }
}
