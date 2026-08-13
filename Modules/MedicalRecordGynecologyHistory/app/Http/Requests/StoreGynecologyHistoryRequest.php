<?php

namespace Modules\MedicalRecordGynecologyHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGynecologyHistoryRequest extends FormRequest
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
            'menarche_age' => ['nullable','integer','min:5','max:25'],
            'menstrual_cycle_pattern' => ['nullable','string','max:255'],
            'contraception_history' => ['nullable','string'],
            'gynecological_surgery_history' => ['nullable','string'],
            'notes' => ['nullable','string'],
        ];
    }
}
