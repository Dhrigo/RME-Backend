<?php

namespace Modules\GeneralCountry\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralCountry\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return Country::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:countries,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:countries,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Country::create($data)->refresh(), 201);
    }

    public function show(Country $country): Country
    {
        return $country;
    }

    public function update(Request $request, Country $country): Country
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('countries', 'name')->ignore($country->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('countries', 'code')->ignore($country->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $country->update($data);

        return $country;
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json(null, 204);
    }
}
