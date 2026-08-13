<?php

namespace Modules\MedicalRecordHemodialysisLetter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HemodialysisLetterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $letterId = $this->route('letter')?->id ?? $this->route('letter');

        return [
            'letter_number' => ['required', 'string', 'max:255', 'unique:hemodialysis_letters,letter_number,' . $letterId],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'issue_date' => ['required', 'date'],
            'diagnosis' => ['nullable', 'string'],
            'hd_frequency_per_week' => ['nullable', 'integer', 'min:1', 'max:7'],
            'vascular_access' => ['nullable', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
