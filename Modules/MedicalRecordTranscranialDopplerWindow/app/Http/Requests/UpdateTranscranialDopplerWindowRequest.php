<?php

namespace Modules\MedicalRecordTranscranialDopplerWindow\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTranscranialDopplerWindowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transcranial_doppler_examination_id' => 'sometimes|required|integer',
            'window_site' => 'sometimes|required|string|in:temporal,orbital,suboccipital,submandibular',
            'signal_quality' => 'nullable|string|in:good,fair,poor,absent',
            'depth_mm' => 'nullable|integer|min:0',
            'velocity_cm_s' => 'nullable|numeric|min:0',
        ];
    }
}
