<?php

namespace Modules\GeneralGuarantorWardAccess\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuarantorWardAccessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_allowed' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
