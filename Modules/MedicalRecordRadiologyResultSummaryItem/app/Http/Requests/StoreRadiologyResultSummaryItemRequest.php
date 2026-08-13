<?php

namespace Modules\MedicalRecordRadiologyResultSummaryItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRadiologyResultSummaryItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'summary_id' => ['required', 'integer', 'exists:radiology_result_summaries,id'],
            'exam_name' => ['required','string','max:255'],
            'finding' => ['nullable','string'],
            'impression' => ['nullable','string'],
            'performed_at' => ['nullable','date'],
        ];
    }
}
