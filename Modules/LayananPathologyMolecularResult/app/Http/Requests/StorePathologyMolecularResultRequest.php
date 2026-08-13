<?php

namespace Modules\LayananPathologyMolecularResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePathologyMolecularResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pathology_anatomy_result_id' => ['required', 'integer', 'exists:pathology_anatomy_results,id'],
            'test_name' => ['required', 'string', 'max:255'],
            'result' => ['required', 'string'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
