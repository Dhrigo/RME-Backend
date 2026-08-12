<?php

namespace Modules\GeneralWard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralWard\Models\Ward;

class WardController extends Controller
{
    public function index()
    {
        return Ward::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:wards,name'],
            'type_id' => ['nullable', 'integer'],
            'visit_type_id' => ['nullable', 'integer'],
            'allows_request' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['created_by'] = $request->user()->id;

        return response()->json(Ward::create($data)->refresh(), 201);
    }

    public function show(Ward $ward): Ward
    {
        return $ward;
    }

    public function update(Request $request, Ward $ward): Ward
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('wards', 'name')->ignore($ward->id)],
            'type_id' => ['nullable', 'integer'],
            'visit_type_id' => ['nullable', 'integer'],
            'allows_request' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $ward->update($data);

        return $ward;
    }

    public function destroy(Ward $ward)
    {
        $ward->delete();

        return response()->json(null, 204);
    }
}
