<?php

namespace Modules\LayananPharmacyServiceFee\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPharmacyServiceFee\Http\Requests\StorePharmacyServiceFeeRequest;
use Modules\LayananPharmacyServiceFee\Http\Requests\UpdatePharmacyServiceFeeRequest;
use Modules\LayananPharmacyServiceFee\Http\Resources\PharmacyServiceFeeResource;
use Modules\LayananPharmacyServiceFee\Models\PharmacyServiceFee;

class PharmacyServiceFeeController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyServiceFee::query();

        return PharmacyServiceFeeResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyServiceFeeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $service_fee = PharmacyServiceFee::create($data);

        return (new PharmacyServiceFeeResource($service_fee))->response()->setStatusCode(201);
    }

    public function show(PharmacyServiceFee $service_fee): PharmacyServiceFeeResource
    {
        return new PharmacyServiceFeeResource($service_fee);
    }

    public function update(UpdatePharmacyServiceFeeRequest $request, PharmacyServiceFee $service_fee): PharmacyServiceFeeResource
    {
        $service_fee->update($request->validated());

        return new PharmacyServiceFeeResource($service_fee);
    }

    public function destroy(PharmacyServiceFee $service_fee)
    {
        $service_fee->delete();

        return response()->json(null, 204);
    }
}
