<?php

namespace Modules\GeneralIcdOTopography\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralIcdOTopography\Models\IcdOTopography;

class IcdOTopographyController extends Controller
{
    public function index()
    {
        return IcdOTopography::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:icd_o_topographies,name'],
            'code' => ['nullable', 'string', 'max:15', 'unique:icd_o_topographies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(IcdOTopography::create($data)->refresh(), 201);
    }

    public function show(IcdOTopography $icd_o_topography): IcdOTopography
    {
        return $icd_o_topography;
    }

    public function update(Request $request, IcdOTopography $icd_o_topography): IcdOTopography
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('icd_o_topographies', 'name')->ignore($icd_o_topography->id)],
            'code' => ['nullable', 'string', 'max:15', Rule::unique('icd_o_topographies', 'code')->ignore($icd_o_topography->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $icd_o_topography->update($data);

        return $icd_o_topography;
    }

    public function destroy(IcdOTopography $icd_o_topography)
    {
        $icd_o_topography->delete();

        return response()->json(null, 204);
    }
}
