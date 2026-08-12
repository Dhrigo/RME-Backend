<?php

namespace Modules\GeneralIcdSnomedCtMapping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralIcdSnomedCtMapping\Models\IcdSnomedCtMapping;

class IcdSnomedCtMappingController extends Controller
{
    public function index()
    {
        return IcdSnomedCtMapping::query()->orderBy('icd_code')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icd_code' => [
                'required', 'string', 'max:20',
                Rule::unique('icd_snomed_ct_mappings')->where(fn ($q) => $q->where('snomed_code', $request->input('snomed_code'))),
            ],
            'snomed_code' => ['required', 'string', 'max:20'],
            'icd_description' => ['nullable', 'string', 'max:255'],
            'snomed_description' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(IcdSnomedCtMapping::create($data)->refresh(), 201);
    }

    public function show(IcdSnomedCtMapping $icd_snomed_ct_mapping): IcdSnomedCtMapping
    {
        return $icd_snomed_ct_mapping;
    }

    public function update(Request $request, IcdSnomedCtMapping $icd_snomed_ct_mapping): IcdSnomedCtMapping
    {
        $data = $request->validate([
            'icd_code' => ['sometimes', 'string', 'max:20'],
            'snomed_code' => ['sometimes', 'string', 'max:20'],
            'icd_description' => ['nullable', 'string', 'max:255'],
            'snomed_description' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $icd_snomed_ct_mapping->update($data);

        return $icd_snomed_ct_mapping;
    }

    public function destroy(IcdSnomedCtMapping $icd_snomed_ct_mapping)
    {
        $icd_snomed_ct_mapping->delete();

        return response()->json(null, 204);
    }
}
