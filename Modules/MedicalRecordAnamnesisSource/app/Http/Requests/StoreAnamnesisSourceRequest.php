<?php

namespace Modules\MedicalRecordAnamnesisSource\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnamnesisSourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anamnesis_id' => ['required', 'integer', 'exists:anamneses,id'],
            'source_type' => ['required', 'string', 'max:50'],
            'source_name' => ['nullable', 'string', 'max:150'],
            'relationship' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
