<?php

namespace Modules\GeneralServiceType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralServiceType\Models\ServiceType;

class ServiceTypeController extends Controller
{
    public function index()
    {
        return ServiceType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:service_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:service_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ServiceType::create($data)->refresh(), 201);
    }

    public function show(ServiceType $service_type): ServiceType
    {
        return $service_type;
    }

    public function update(Request $request, ServiceType $service_type): ServiceType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('service_types', 'name')->ignore($service_type->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('service_types', 'code')->ignore($service_type->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $service_type->update($data);

        return $service_type;
    }

    public function destroy(ServiceType $service_type)
    {
        $service_type->delete();

        return response()->json(null, 204);
    }
}
