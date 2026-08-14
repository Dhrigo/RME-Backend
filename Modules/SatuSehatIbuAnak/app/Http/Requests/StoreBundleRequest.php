<?php

namespace Modules\SatuSehatIbuAnak\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates the FHIR Bundle envelope for a single "Pengiriman dengan Bundle"
 * use-case submission (ANC/INC/PNC/Neonatus/SHK/Kematian Maternal/Data
 * Kelahiran). kemkes_research_findings.md / part2.md section 3 confirm each
 * use-case collection ends in exactly one "POST Bundle ..." request, but no
 * literal example JSON body was captured for any of them (only folder names
 * and step counts) - so this module intentionally passes the Bundle through
 * as supplied by the caller rather than reconstructing per-field FHIR
 * resources it has no verified schema for. Only the outer Bundle envelope is
 * validated.
 */
class StoreBundleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resourceType' => ['required', 'in:Bundle'],
            'identifier' => ['nullable', 'array'],
            'entry' => ['required', 'array', 'min:1'],
            'entry.*.resource' => ['required', 'array'],
            'entry.*.resource.resourceType' => ['required', 'string'],
        ];
    }
}
