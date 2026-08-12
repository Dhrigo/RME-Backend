<?php

namespace Modules\KemkesBloodType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\KemkesBloodType\Models\BloodType;

class BloodTypeController extends Controller
{
    public function index()
    {
        return BloodType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:blood_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:blood_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(BloodType::create($data)->refresh(), 201);
    }

    public function show(BloodType $bloodtype): BloodType
    {
        return $bloodtype;
    }

    public function update(Request $request, BloodType $bloodtype): BloodType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('blood_types', 'name')->ignore($bloodtype->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('blood_types', 'code')->ignore($bloodtype->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $bloodtype->update($data);

        return $bloodtype;
    }

    public function destroy(BloodType $bloodtype)
    {
        $bloodtype->delete();

        return response()->json(null, 204);
    }
}
