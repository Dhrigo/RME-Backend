<?php

namespace Modules\PegawaiPracticeLicense\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePracticeLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'expires_at' => ['nullable', 'date'],
            'issuing_authority' => ['nullable', 'string', 'max:255'],
        ];
    }
}
