<?php

namespace Modules\MedicalRecordUpperGiTractExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpperGiTractExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'procedure_type' => 'nullable|string|max:50',
            'esophagus_findings' => 'nullable|string',
            'stomach_findings' => 'nullable|string',
            'duodenum_findings' => 'nullable|string',
            'hpylori_result' => 'nullable|string|in:positive,negative,not_tested',
            'examined_at' => 'nullable|date',
        ];
    }
}
