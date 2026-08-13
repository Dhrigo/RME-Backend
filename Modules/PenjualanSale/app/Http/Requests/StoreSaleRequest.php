<?php

namespace Modules\PenjualanSale\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['nullable', 'integer', 'exists:patients,id'],
            'sold_by' => ['required', 'integer', 'exists:employees,id'],
            'sold_at' => ['nullable', 'date'],
            'total_amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
