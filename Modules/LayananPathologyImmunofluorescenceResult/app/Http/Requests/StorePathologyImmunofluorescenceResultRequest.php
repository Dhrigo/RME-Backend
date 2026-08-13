<?php

namespace Modules\LayananPathologyImmunofluorescenceResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePathologyImmunofluorescenceResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pathology_anatomy_result_id' => ['required', 'integer', 'exists:pathology_anatomy_results,id'],
            'marker' => ['required', 'string', 'max:255'],
            'result' => ['required', 'string', 'max:255'],
            'intensity' => ['nullable', 'string', 'max:255'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
