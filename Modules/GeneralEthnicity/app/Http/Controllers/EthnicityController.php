<?php

namespace Modules\GeneralEthnicity\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralEthnicity\Models\Ethnicity;

class EthnicityController extends Controller
{
    public function index()
    {
        return Ethnicity::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ethnicities,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:ethnicities,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Ethnicity::create($data)->refresh(), 201);
    }

    public function show(Ethnicity $ethnicity): Ethnicity
    {
        return $ethnicity;
    }

    public function update(Request $request, Ethnicity $ethnicity): Ethnicity
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('ethnicities', 'name')->ignore($ethnicity->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('ethnicities', 'code')->ignore($ethnicity->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $ethnicity->update($data);

        return $ethnicity;
    }

    public function destroy(Ethnicity $ethnicity)
    {
        $ethnicity->delete();

        return response()->json(null, 204);
    }
}
