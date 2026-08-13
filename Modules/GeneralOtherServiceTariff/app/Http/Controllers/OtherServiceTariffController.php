<?php

namespace Modules\GeneralOtherServiceTariff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralOtherServiceTariff\Http\Requests\StoreOtherServiceTariffRequest;
use Modules\GeneralOtherServiceTariff\Http\Requests\UpdateOtherServiceTariffRequest;
use Modules\GeneralOtherServiceTariff\Http\Resources\OtherServiceTariffResource;
use Modules\GeneralOtherServiceTariff\Models\OtherServiceTariff;

class OtherServiceTariffController extends Controller
{
    public function index(Request $request)
    {
        $query = OtherServiceTariff::query();

        if ($request->filled('other_service_id')) {
            $query->where('other_service_id', $request->integer('other_service_id'));
        }

        return OtherServiceTariffResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreOtherServiceTariffRequest $request)
    {
        $tariff = OtherServiceTariff::create($request->validated());

        return (new OtherServiceTariffResource($tariff))->response()->setStatusCode(201);
    }

    public function show(OtherServiceTariff $other_service_tariff): OtherServiceTariffResource
    {
        return new OtherServiceTariffResource($other_service_tariff);
    }

    public function update(UpdateOtherServiceTariffRequest $request, OtherServiceTariff $other_service_tariff): OtherServiceTariffResource
    {
        $other_service_tariff->update($request->validated());

        return new OtherServiceTariffResource($other_service_tariff);
    }

    public function destroy(OtherServiceTariff $other_service_tariff)
    {
        $other_service_tariff->delete();

        return response()->json(null, 204);
    }
}
