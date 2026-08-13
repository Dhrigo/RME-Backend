<?php

namespace Modules\PegawaiEmployeeContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_type' => ['sometimes', 'string', 'in:phone,email,emergency'],
            'value' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
