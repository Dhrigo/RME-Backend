<?php

namespace Modules\LayananMedicationServiceLimit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicationServiceLimitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => ['sometimes', 'integer', 'exists:items,id'],
            'guarantor_type' => ['sometimes', 'string', 'max:255'],
            'max_quantity_per_month' => ['sometimes', 'integer'],
            'max_days_supply' => ['sometimes', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
