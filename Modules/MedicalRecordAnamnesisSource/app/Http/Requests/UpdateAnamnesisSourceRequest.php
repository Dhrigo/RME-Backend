<?php

namespace Modules\MedicalRecordAnamnesisSource\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnamnesisSourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anamnesis_id' => ['sometimes', 'integer', 'exists:anamneses,id'],
            'source_type' => ['sometimes', 'string', 'max:50'],
            'source_name' => ['nullable', 'string', 'max:150'],
            'relationship' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
