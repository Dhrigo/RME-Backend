<?php

namespace Modules\LayananAntimicrobialStewardshipFormItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntimicrobialStewardshipFormItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => ['required', 'integer', 'exists:antimicrobial_stewardship_forms,id'],
            'item_id' => ['nullable', 'integer', 'exists:items,id'],
            'dose' => ['required', 'string', 'max:255'],
            'route' => ['required', 'string', 'max:255'],
            'frequency' => ['required', 'string', 'max:255'],
            'planned_duration_days' => ['nullable', 'integer'],
        ];
    }
}
