<?php

namespace Modules\GeneralPackageTariffDistribution\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPackageTariffDistribution\Http\Requests\StorePackageTariffDistributionRequest;
use Modules\GeneralPackageTariffDistribution\Http\Requests\UpdatePackageTariffDistributionRequest;
use Modules\GeneralPackageTariffDistribution\Http\Resources\PackageTariffDistributionResource;
use Modules\GeneralPackageTariffDistribution\Models\PackageTariffDistribution;

class PackageTariffDistributionController extends Controller
{
    public function index(Request $request)
    {
        $query = PackageTariffDistribution::query();

        if ($request->filled('package_id')) {
            $query->where('package_id', $request->integer('package_id'));
        }

        return PackageTariffDistributionResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePackageTariffDistributionRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $distribution = PackageTariffDistribution::create($data);

        return (new PackageTariffDistributionResource($distribution))->response()->setStatusCode(201);
    }

    public function show(PackageTariffDistribution $package_tariff_distribution): PackageTariffDistributionResource
    {
        return new PackageTariffDistributionResource($package_tariff_distribution);
    }

    public function update(UpdatePackageTariffDistributionRequest $request, PackageTariffDistribution $package_tariff_distribution): PackageTariffDistributionResource
    {
        $package_tariff_distribution->update($request->validated());

        return new PackageTariffDistributionResource($package_tariff_distribution);
    }

    public function destroy(PackageTariffDistribution $package_tariff_distribution)
    {
        $package_tariff_distribution->delete();

        return response()->json(null, 204);
    }
}
