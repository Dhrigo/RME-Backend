<?php

namespace Modules\MedicalRecordObstetricHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObstetricHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'pregnancy_number' => ['nullable','integer','min:1'],
            'delivery_date' => ['nullable','date'],
            'delivery_method' => ['nullable','in:normal,cesarean,vacuum,forceps'],
            'birth_weight_grams' => ['nullable','integer','min:0'],
            'complications' => ['nullable','string'],
            'outcome' => ['nullable','string','max:255'],
        ];
    }
}
