<?php

namespace Modules\GeneralPhysicianRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralPhysicianRestriction\Models\PhysicianRestriction;

class StorePhysicianRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'restricted_antibiotic_name' => ['required', 'string', 'max:255'],
            'authorization_level' => ['sometimes', 'string', Rule::in(PhysicianRestriction::AUTHORIZATION_LEVELS)],
            'is_authorized_prescriber' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
