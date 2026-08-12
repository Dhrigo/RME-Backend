<?php

namespace Modules\GeneralPackage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPackage\Http\Requests\StorePackageRequest;
use Modules\GeneralPackage\Http\Requests\UpdatePackageRequest;
use Modules\GeneralPackage\Http\Resources\PackageResource;
use Modules\GeneralPackage\Models\Package;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->string('name').'%');
        }

        return PackageResource::collection($query->orderBy('name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->validated());

        return (new PackageResource($package))->response()->setStatusCode(201);
    }

    public function show(Package $package): PackageResource
    {
        return new PackageResource($package);
    }

    public function update(UpdatePackageRequest $request, Package $package): PackageResource
    {
        $package->update($request->validated());

        return new PackageResource($package);
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return response()->json(null, 204);
    }
}
