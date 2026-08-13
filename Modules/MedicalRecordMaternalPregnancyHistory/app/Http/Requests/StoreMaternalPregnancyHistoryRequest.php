<?php

namespace Modules\MedicalRecordMaternalPregnancyHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaternalPregnancyHistoryRequest extends FormRequest
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
            'gravida' => ['nullable','integer','min:0'],
            'para' => ['nullable','integer','min:0'],
            'abortus' => ['nullable','integer','min:0'],
            'pregnancy_complications' => ['nullable','string'],
            'delivery_method_history' => ['nullable','string'],
        ];
    }
}
