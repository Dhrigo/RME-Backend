<?php

namespace Modules\GeneralPatientIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'id_type' => ['required', 'string', 'in:KTP,SIM,Kartu Pelajar,Passport,KITAS,KITAP,KTP WNA'],
            'id_number' => ['required', 'string', 'max:50'],
            'issued_at' => ['nullable', 'date'],
        ];
    }
}
