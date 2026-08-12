<?php

namespace Modules\GeneralServiceTariff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralServiceTariff\Http\Requests\StoreServiceTariffRequest;
use Modules\GeneralServiceTariff\Http\Requests\UpdateServiceTariffRequest;
use Modules\GeneralServiceTariff\Http\Resources\ServiceTariffResource;
use Modules\GeneralServiceTariff\Models\ServiceTariff;

class ServiceTariffController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceTariff::query();

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->integer('service_id'));
        }

        return ServiceTariffResource::collection($query->latest('effective_date')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreServiceTariffRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $tariff = ServiceTariff::create($data);

        return (new ServiceTariffResource($tariff))->response()->setStatusCode(201);
    }

    public function show(ServiceTariff $service_tariff): ServiceTariffResource
    {
        return new ServiceTariffResource($service_tariff);
    }

    public function update(UpdateServiceTariffRequest $request, ServiceTariff $service_tariff): ServiceTariffResource
    {
        $service_tariff->update($request->validated());

        return new ServiceTariffResource($service_tariff);
    }

    public function destroy(ServiceTariff $service_tariff)
    {
        $service_tariff->delete();

        return response()->json(null, 204);
    }
}
