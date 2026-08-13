<?php

namespace Modules\MedicalRecordImageMarker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageMarkerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'image_path' => 'sometimes|required|string|max:255',
            'template_name' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'marked_at' => 'nullable|date',
        ];
    }
}
