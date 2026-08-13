<?php

namespace Modules\GeneralGuarantorWardAccess\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuarantorWardAccessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guarantor_id' => ['required', 'integer', 'exists:guarantors,id'],
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'is_allowed' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
