<?php

namespace Modules\GeneralPhysicianRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralPhysicianRestriction\Models\PhysicianRestriction;

class UpdatePhysicianRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'authorization_level' => ['sometimes', 'string', Rule::in(PhysicianRestriction::AUTHORIZATION_LEVELS)],
            'is_authorized_prescriber' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
