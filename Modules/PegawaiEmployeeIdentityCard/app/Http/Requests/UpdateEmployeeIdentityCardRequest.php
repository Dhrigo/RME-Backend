<?php

namespace Modules\PegawaiEmployeeIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_type' => ['sometimes', 'string', 'in:KTP,SIM,Paspor'],
            'id_number' => ['sometimes', 'string', 'max:50'],
            'issued_at' => ['nullable', 'date'],
        ];
    }
}
