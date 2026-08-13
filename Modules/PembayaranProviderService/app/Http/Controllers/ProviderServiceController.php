<?php

namespace Modules\PembayaranProviderService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranProviderService\Http\Requests\StoreProviderServiceRequest;
use Modules\PembayaranProviderService\Http\Requests\UpdateProviderServiceRequest;
use Modules\PembayaranProviderService\Http\Resources\ProviderServiceResource;
use Modules\PembayaranProviderService\Models\ProviderService;

class ProviderServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = ProviderService::query();

        if ($request->filled('payment_provider_id')) {
            $query->where('payment_provider_id', $request->integer('payment_provider_id'));
        }

        return ProviderServiceResource::collection($query->orderBy('service_name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreProviderServiceRequest $request)
    {
        $data = $request->validated();
        $data['service_type'] ??= 'va_transfer';
        $data['admin_fee_type'] ??= 'flat';
        $data['admin_fee_amount'] ??= 0;
        $data['is_active'] ??= true;

        $service = ProviderService::create($data);

        return (new ProviderServiceResource($service))->response()->setStatusCode(201);
    }

    public function show(ProviderService $provider_service): ProviderServiceResource
    {
        return new ProviderServiceResource($provider_service);
    }

    public function update(UpdateProviderServiceRequest $request, ProviderService $provider_service): ProviderServiceResource
    {
        $provider_service->update($request->validated());

        return new ProviderServiceResource($provider_service);
    }

    public function destroy(ProviderService $provider_service)
    {
        $provider_service->delete();

        return response()->json(null, 204);
    }
}
