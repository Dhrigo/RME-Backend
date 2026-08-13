<?php

namespace Modules\GeneralPackageTariffDistributionItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPackageTariffDistributionItem\Http\Requests\StorePackageTariffDistributionItemRequest;
use Modules\GeneralPackageTariffDistributionItem\Http\Requests\UpdatePackageTariffDistributionItemRequest;
use Modules\GeneralPackageTariffDistributionItem\Http\Resources\PackageTariffDistributionItemResource;
use Modules\GeneralPackageTariffDistributionItem\Models\PackageTariffDistributionItem;

class PackageTariffDistributionItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PackageTariffDistributionItem::query();

        if ($request->filled('package_tariff_distribution_id')) {
            $query->where('package_tariff_distribution_id', $request->integer('package_tariff_distribution_id'));
        }

        return PackageTariffDistributionItemResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePackageTariffDistributionItemRequest $request)
    {
        $item = PackageTariffDistributionItem::create($request->validated());

        return (new PackageTariffDistributionItemResource($item))->response()->setStatusCode(201);
    }

    public function show(PackageTariffDistributionItem $distribution_item): PackageTariffDistributionItemResource
    {
        return new PackageTariffDistributionItemResource($distribution_item);
    }

    public function update(UpdatePackageTariffDistributionItemRequest $request, PackageTariffDistributionItem $distribution_item): PackageTariffDistributionItemResource
    {
        $distribution_item->update($request->validated());

        return new PackageTariffDistributionItemResource($distribution_item);
    }

    public function destroy(PackageTariffDistributionItem $distribution_item)
    {
        $distribution_item->delete();

        return response()->json(null, 204);
    }
}
