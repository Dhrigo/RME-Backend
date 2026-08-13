<?php

namespace Modules\MedicalRecordNursingIndicator\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingIndicatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['nullable', 'string', 'max:30'],
            'name' => ['required', 'string', 'max:150'],
            'nursing_indicator_type_id' => ['nullable', 'integer', 'exists:nursing_indicator_types,id'],
            'unit' => ['nullable', 'string', 'max:50'],
            'target_value' => ['nullable', 'string', 'max:50'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
