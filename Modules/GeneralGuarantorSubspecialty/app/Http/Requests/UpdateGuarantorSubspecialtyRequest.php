<?php

namespace Modules\GeneralGuarantorSubspecialty\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuarantorSubspecialtyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subspecialty_name' => ['sometimes', 'string', 'max:255'],
            'is_covered' => ['sometimes', 'boolean'],
            'coverage_note' => ['nullable', 'string'],
        ];
    }
}
