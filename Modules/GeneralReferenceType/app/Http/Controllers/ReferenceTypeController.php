<?php

namespace Modules\GeneralReferenceType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralReferenceType\Models\ReferenceType;

class ReferenceTypeController extends Controller
{
    public function index()
    {
        return ReferenceType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:reference_types,name'],
            'abbreviation' => ['required', 'string', 'max:5'],
            'is_application' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ReferenceType::create($data)->refresh(), 201);
    }

    public function show(ReferenceType $referenceType): ReferenceType
    {
        return $referenceType;
    }

    public function update(Request $request, ReferenceType $referenceType): ReferenceType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('reference_types', 'name')->ignore($referenceType->id)],
            'abbreviation' => ['sometimes', 'string', 'max:5'],
            'is_application' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $referenceType->update($data);

        return $referenceType;
    }

    public function destroy(ReferenceType $referenceType)
    {
        $referenceType->delete();

        return response()->json(null, 204);
    }
}
