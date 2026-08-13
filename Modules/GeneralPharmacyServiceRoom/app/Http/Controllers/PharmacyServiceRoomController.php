<?php

namespace Modules\GeneralPharmacyServiceRoom\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPharmacyServiceRoom\Http\Requests\StorePharmacyServiceRoomRequest;
use Modules\GeneralPharmacyServiceRoom\Http\Requests\UpdatePharmacyServiceRoomRequest;
use Modules\GeneralPharmacyServiceRoom\Http\Resources\PharmacyServiceRoomResource;
use Modules\GeneralPharmacyServiceRoom\Models\PharmacyServiceRoom;

class PharmacyServiceRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyServiceRoom::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return PharmacyServiceRoomResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyServiceRoomRequest $request)
    {
        $room = PharmacyServiceRoom::create($request->validated());

        return (new PharmacyServiceRoomResource($room))->response()->setStatusCode(201);
    }

    public function show(PharmacyServiceRoom $pharmacy_service_room): PharmacyServiceRoomResource
    {
        return new PharmacyServiceRoomResource($pharmacy_service_room);
    }

    public function update(UpdatePharmacyServiceRoomRequest $request, PharmacyServiceRoom $pharmacy_service_room): PharmacyServiceRoomResource
    {
        $pharmacy_service_room->update($request->validated());

        return new PharmacyServiceRoomResource($pharmacy_service_room);
    }

    public function destroy(PharmacyServiceRoom $pharmacy_service_room)
    {
        $pharmacy_service_room->delete();

        return response()->json(null, 204);
    }
}
