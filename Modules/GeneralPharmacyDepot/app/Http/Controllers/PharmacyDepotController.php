<?php

namespace Modules\GeneralPharmacyDepot\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPharmacyDepot\Http\Requests\StorePharmacyDepotRequest;
use Modules\GeneralPharmacyDepot\Http\Requests\UpdatePharmacyDepotRequest;
use Modules\GeneralPharmacyDepot\Http\Resources\PharmacyDepotResource;
use Modules\GeneralPharmacyDepot\Models\PharmacyDepot;

class PharmacyDepotController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyDepot::query();

        return PharmacyDepotResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyDepotRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $pharmacy_depot = PharmacyDepot::create($data);

        return (new PharmacyDepotResource($pharmacy_depot))->response()->setStatusCode(201);
    }

    public function show(PharmacyDepot $pharmacy_depot): PharmacyDepotResource
    {
        return new PharmacyDepotResource($pharmacy_depot);
    }

    public function update(UpdatePharmacyDepotRequest $request, PharmacyDepot $pharmacy_depot): PharmacyDepotResource
    {
        $pharmacy_depot->update($request->validated());

        return new PharmacyDepotResource($pharmacy_depot);
    }

    public function destroy(PharmacyDepot $pharmacy_depot)
    {
        $pharmacy_depot->delete();

        return response()->json(null, 204);
    }
}
