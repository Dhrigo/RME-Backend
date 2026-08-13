<?php

namespace Modules\PembayaranPaymentProvider\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranPaymentProvider\Http\Requests\StorePaymentProviderRequest;
use Modules\PembayaranPaymentProvider\Http\Requests\UpdatePaymentProviderRequest;
use Modules\PembayaranPaymentProvider\Http\Resources\PaymentProviderResource;
use Modules\PembayaranPaymentProvider\Models\PaymentProvider;

class PaymentProviderController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentProvider::query();

        if ($request->filled('provider_type')) {
            $query->where('provider_type', $request->string('provider_type'));
        }

        return PaymentProviderResource::collection($query->orderBy('provider_name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePaymentProviderRequest $request)
    {
        $data = $request->validated();
        $data['provider_type'] ??= 'bank';
        $data['is_active'] ??= true;

        $provider = PaymentProvider::create($data);

        return (new PaymentProviderResource($provider))->response()->setStatusCode(201);
    }

    public function show(PaymentProvider $payment_provider): PaymentProviderResource
    {
        return new PaymentProviderResource($payment_provider);
    }

    public function update(UpdatePaymentProviderRequest $request, PaymentProvider $payment_provider): PaymentProviderResource
    {
        $payment_provider->update($request->validated());

        return new PaymentProviderResource($payment_provider);
    }

    public function destroy(PaymentProvider $payment_provider)
    {
        $payment_provider->delete();

        return response()->json(null, 204);
    }
}
