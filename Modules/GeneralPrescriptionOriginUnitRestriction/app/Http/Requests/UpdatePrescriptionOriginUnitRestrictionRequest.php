<?php

namespace Modules\GeneralPrescriptionOriginUnitRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionOriginUnitRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'item_id' => ['sometimes', 'integer', 'exists:items,id'],
            'is_allowed' => ['sometimes', 'boolean'],
            'note' => ['sometimes', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
