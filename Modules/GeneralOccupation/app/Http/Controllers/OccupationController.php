<?php

namespace Modules\GeneralOccupation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralOccupation\Models\Occupation;

class OccupationController extends Controller
{
    public function index()
    {
        return Occupation::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:occupations,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:occupations,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Occupation::create($data)->refresh(), 201);
    }

    public function show(Occupation $occupation): Occupation
    {
        return $occupation;
    }

    public function update(Request $request, Occupation $occupation): Occupation
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('occupations', 'name')->ignore($occupation->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('occupations', 'code')->ignore($occupation->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $occupation->update($data);

        return $occupation;
    }

    public function destroy(Occupation $occupation)
    {
        $occupation->delete();

        return response()->json(null, 204);
    }
}
