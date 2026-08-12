<?php

namespace Modules\GeneralPackageService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPackageService\Models\PackageService;

class PackageServiceController extends Controller
{
    public function index()
    {
        return PackageService::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'package_id' => ['nullable', 'integer'],
            'service_id' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PackageService::create($data)->refresh(), 201);
    }

    public function show(PackageService $packageService): PackageService
    {
        return $packageService;
    }

    public function update(Request $request, PackageService $packageService): PackageService
    {
        $data = $request->validate([
            'package_id' => ['nullable', 'integer'],
            'service_id' => ['nullable', 'integer'],
            'quantity' => ['sometimes', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $packageService->update($data);
        return $packageService;
    }

    public function destroy(PackageService $packageService)
    {
        $packageService->delete();
        return response()->json(null, 204);
    }
}
