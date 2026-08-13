<?php

namespace Modules\GeneralGuarantorSubspecialty\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuarantorSubspecialtyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guarantor_id' => ['required', 'integer', 'exists:guarantors,id'],
            'subspecialty_name' => ['required', 'string', 'max:255'],
            'is_covered' => ['sometimes', 'boolean'],
            'coverage_note' => ['nullable', 'string'],
        ];
    }
}
