<?php

namespace Modules\SatuSehatPtmRegistry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates the FHIR Bundle envelope for a single PTM registry use-case
 * submission (Skrining PTM/Kanker/Jantung/Stroke/Uronefrologi). Same
 * rationale as SatuSehatIbuAnak\StoreBundleRequest - research
 * (kemkes_research_findings.md section 4, part2.md section 3) only confirmed
 * collection/folder names and that each ends in a registration flow, not
 * literal per-field JSON, so the Bundle is passed through as supplied by the
 * caller.
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
