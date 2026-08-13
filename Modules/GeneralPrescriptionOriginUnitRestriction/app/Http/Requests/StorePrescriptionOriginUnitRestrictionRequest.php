<?php

namespace Modules\GeneralPrescriptionOriginUnitRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionOriginUnitRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'item_id' => ['nullable', 'integer', 'exists:items,id'],
            'is_allowed' => ['sometimes', 'boolean'],
            'note' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
