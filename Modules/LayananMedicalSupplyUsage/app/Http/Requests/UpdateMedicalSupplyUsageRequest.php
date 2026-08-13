<?php

namespace Modules\LayananMedicalSupplyUsage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedicalSupplyUsageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'recorded_by' => ['sometimes', 'integer', 'exists:users,id'],
            'used_at' => ['sometimes', 'date'],
            'status' => ['sometimes', Rule::in(['draft', 'posted'])],
        ];
    }
}
