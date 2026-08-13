<?php

namespace Modules\BerkasKlaimPathologyClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePathologyClaimRequest extends FormRequest
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
