<?php

namespace Modules\MedicalRecordLabResultSummaryItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabResultSummaryItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'summary_id' => ['required', 'integer', 'exists:lab_result_summaries,id'],
            'lab_test_name' => ['required','string','max:255'],
            'result_value' => ['required','string','max:50'],
            'unit' => ['nullable','string','max:20'],
            'reference_range' => ['nullable','string','max:50'],
            'flag' => ['nullable','in:normal,high,low,critical'],
            'tested_at' => ['nullable','date'],
        ];
    }
}
