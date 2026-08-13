<?php

namespace Modules\GeneralIcdOMorphology\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralIcdOMorphology\Models\IcdOMorphology;

class IcdOMorphologyController extends Controller
{
    public function index()
    {
        return IcdOMorphology::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:icd_o_morphologies,name'],
            'code' => ['nullable', 'string', 'max:15', 'unique:icd_o_morphologies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(IcdOMorphology::create($data)->refresh(), 201);
    }

    public function show(IcdOMorphology $icd_o_morphology): IcdOMorphology
    {
        return $icd_o_morphology;
    }

    public function update(Request $request, IcdOMorphology $icd_o_morphology): IcdOMorphology
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('icd_o_morphologies', 'name')->ignore($icd_o_morphology->id)],
            'code' => ['nullable', 'string', 'max:15', Rule::unique('icd_o_morphologies', 'code')->ignore($icd_o_morphology->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $icd_o_morphology->update($data);

        return $icd_o_morphology;
    }

    public function destroy(IcdOMorphology $icd_o_morphology)
    {
        $icd_o_morphology->delete();

        return response()->json(null, 204);
    }
}
