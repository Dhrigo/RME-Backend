<?php

namespace Modules\GeneralServiceTariffDistribution\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralServiceTariffDistribution\Models\ServiceTariffDistribution;

class ServiceTariffDistributionController extends Controller
{
    public function index()
    {
        return ServiceTariffDistribution::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_tariff_id' => ['nullable', 'integer'],
            'component_id' => ['nullable', 'integer'],
            'amount' => ['required', 'numeric'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ServiceTariffDistribution::create($data)->refresh(), 201);
    }

    public function show(ServiceTariffDistribution $serviceTariffDistribution): ServiceTariffDistribution
    {
        return $serviceTariffDistribution;
    }

    public function update(Request $request, ServiceTariffDistribution $serviceTariffDistribution): ServiceTariffDistribution
    {
        $data = $request->validate([
            'service_tariff_id' => ['nullable', 'integer'],
            'component_id' => ['nullable', 'integer'],
            'amount' => ['sometimes', 'numeric'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $serviceTariffDistribution->update($data);
        return $serviceTariffDistribution;
    }

    public function destroy(ServiceTariffDistribution $serviceTariffDistribution)
    {
        $serviceTariffDistribution->delete();
        return response()->json(null, 204);
    }
}
