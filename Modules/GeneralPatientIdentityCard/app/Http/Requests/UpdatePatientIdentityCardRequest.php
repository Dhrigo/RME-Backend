<?php

namespace Modules\GeneralPatientIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_type' => ['sometimes', 'string', 'in:KTP,SIM,Kartu Pelajar,Passport,KITAS,KITAP,KTP WNA'],
            'id_number' => ['sometimes', 'string', 'max:50'],
            'issued_at' => ['nullable', 'date'],
        ];
    }
}
