<?php

namespace Modules\GeneralOtherService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralOtherService\Models\OtherService;

class OtherServiceController extends Controller
{
    public function index()
    {
        return OtherService::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:other_services,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:other_services,code'],
            'description' => ['nullable', 'string'],
            'unit' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(OtherService::create($data)->refresh(), 201);
    }

    public function show(OtherService $other_service): OtherService
    {
        return $other_service;
    }

    public function update(Request $request, OtherService $other_service): OtherService
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('other_services', 'name')->ignore($other_service->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('other_services', 'code')->ignore($other_service->id)],
            'description' => ['nullable', 'string'],
            'unit' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $other_service->update($data);

        return $other_service;
    }

    public function destroy(OtherService $other_service)
    {
        $other_service->delete();

        return response()->json(null, 204);
    }
}
