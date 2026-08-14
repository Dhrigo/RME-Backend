<?php

namespace Modules\SatuSehatAnak\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates the FHIR Bundle envelope for a single "Pengiriman dengan Bundle"
 * use-case submission (MTBS/Imunisasi/Gizi/Tumbuh Kembang/PKPR/Imunisasi
 * Covid19). Same rationale as SatuSehatIbuAnak\StoreBundleRequest - the
 * research only confirmed folder names and one "POST Bundle ..." request per
 * use-case, not literal per-field JSON, so the Bundle is passed through as
 * supplied by the caller.
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
