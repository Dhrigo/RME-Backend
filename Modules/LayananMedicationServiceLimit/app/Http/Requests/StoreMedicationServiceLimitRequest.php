<?php

namespace Modules\LayananMedicationServiceLimit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicationServiceLimitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'guarantor_type' => ['nullable', 'string', 'max:255'],
            'max_quantity_per_month' => ['required', 'integer'],
            'max_days_supply' => ['nullable', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
