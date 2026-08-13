<?php

namespace Modules\LayananAntimicrobialStewardshipApproval\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAntimicrobialStewardshipApprovalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => ['required', 'integer', 'exists:antimicrobial_stewardship_forms,id'],
            'approved_by' => ['nullable', 'integer', 'exists:employees,id'],
            'decision' => ['required', Rule::in(['approved', 'rejected'])],
            'decision_note' => ['nullable', 'string'],
            'decided_at' => ['required', 'date'],
        ];
    }
}
