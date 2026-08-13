<?php

namespace Modules\InventoryPharmacyPackage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryPharmacyPackage\Http\Requests\StorePharmacyPackageRequest;
use Modules\InventoryPharmacyPackage\Http\Requests\UpdatePharmacyPackageRequest;
use Modules\InventoryPharmacyPackage\Http\Resources\PharmacyPackageResource;
use Modules\InventoryPharmacyPackage\Models\PharmacyPackage;

class InventoryPharmacyPackageController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyPackage::query();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        return PharmacyPackageResource::collection($query->orderBy('name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyPackageRequest $request)
    {
        $package = PharmacyPackage::create($request->validated());

        return (new PharmacyPackageResource($package))->response()->setStatusCode(201);
    }

    public function show(PharmacyPackage $pharmacy_package): PharmacyPackageResource
    {
        return new PharmacyPackageResource($pharmacy_package);
    }

    public function update(UpdatePharmacyPackageRequest $request, PharmacyPackage $pharmacy_package): PharmacyPackageResource
    {
        $pharmacy_package->update($request->validated());

        return new PharmacyPackageResource($pharmacy_package);
    }

    public function destroy(PharmacyPackage $pharmacy_package)
    {
        $pharmacy_package->delete();

        return response()->json(null, 204);
    }
}
