<?php

namespace Modules\PenjaminRSDischargeMethod\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\PenjaminRSDischargeMethod\Models\DischargeMethod;

class DischargeMethodController extends Controller
{
    public function index()
    {
        return DischargeMethod::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:discharge_methods,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:discharge_methods,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(DischargeMethod::create($data)->refresh(), 201);
    }

    public function show(DischargeMethod $dischargeMethod): DischargeMethod
    {
        return $dischargeMethod;
    }

    public function update(Request $request, DischargeMethod $dischargeMethod): DischargeMethod
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('discharge_methods', 'name')->ignore($dischargeMethod->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('discharge_methods', 'code')->ignore($dischargeMethod->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $dischargeMethod->update($data);

        return $dischargeMethod;
    }

    public function destroy(DischargeMethod $dischargeMethod)
    {
        $dischargeMethod->delete();

        return response()->json(null, 204);
    }
}