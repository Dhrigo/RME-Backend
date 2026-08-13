<?php

namespace Modules\LayananSurgicalSafetyEvaluationResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurgicalSafetyEvaluationResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'operating_room_id' => ['nullable', 'integer', 'exists:operating_rooms,id'],
            'evaluator_id' => ['nullable', 'integer', 'exists:employees,id'],
            'checklist_score' => ['required', 'integer'],
            'compliant' => ['sometimes', 'boolean'],
            'evaluated_at' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
