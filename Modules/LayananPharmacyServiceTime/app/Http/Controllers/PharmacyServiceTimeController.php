<?php

namespace Modules\LayananPharmacyServiceTime\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPharmacyServiceTime\Http\Requests\StorePharmacyServiceTimeRequest;
use Modules\LayananPharmacyServiceTime\Http\Requests\UpdatePharmacyServiceTimeRequest;
use Modules\LayananPharmacyServiceTime\Http\Resources\PharmacyServiceTimeResource;
use Modules\LayananPharmacyServiceTime\Models\PharmacyServiceTime;

class PharmacyServiceTimeController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyServiceTime::query();

        return PharmacyServiceTimeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyServiceTimeRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'pending';

        $record = PharmacyServiceTime::create($data);

        return (new PharmacyServiceTimeResource($record))->response()->setStatusCode(201);
    }

    public function show(PharmacyServiceTime $record): PharmacyServiceTimeResource
    {
        return new PharmacyServiceTimeResource($record);
    }

    public function update(UpdatePharmacyServiceTimeRequest $request, PharmacyServiceTime $record): PharmacyServiceTimeResource
    {
        $record->update($request->validated());

        return new PharmacyServiceTimeResource($record);
    }

    public function destroy(PharmacyServiceTime $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
