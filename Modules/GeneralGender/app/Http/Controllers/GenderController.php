<?php

namespace Modules\GeneralGender\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralGender\Models\Gender;

class GenderController extends Controller
{
    public function index()
    {
        return Gender::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genders,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:genders,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Gender::create($data)->refresh(), 201);
    }

    public function show(Gender $gender): Gender
    {
        return $gender;
    }

    public function update(Request $request, Gender $gender): Gender
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('genders', 'name')->ignore($gender->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('genders', 'code')->ignore($gender->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $gender->update($data);

        return $gender;
    }

    public function destroy(Gender $gender)
    {
        $gender->delete();

        return response()->json(null, 204);
    }
}
