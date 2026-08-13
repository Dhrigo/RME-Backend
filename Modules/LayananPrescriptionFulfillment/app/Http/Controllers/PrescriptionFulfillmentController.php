<?php

namespace Modules\LayananPrescriptionFulfillment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPrescriptionFulfillment\Http\Requests\StorePrescriptionFulfillmentRequest;
use Modules\LayananPrescriptionFulfillment\Http\Requests\UpdatePrescriptionFulfillmentRequest;
use Modules\LayananPrescriptionFulfillment\Http\Resources\PrescriptionFulfillmentResource;
use Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment;

class PrescriptionFulfillmentController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionFulfillment::query();

        return PrescriptionFulfillmentResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionFulfillmentRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'served';

        $record = PrescriptionFulfillment::create($data);

        return (new PrescriptionFulfillmentResource($record))->response()->setStatusCode(201);
    }

    public function show(PrescriptionFulfillment $record): PrescriptionFulfillmentResource
    {
        return new PrescriptionFulfillmentResource($record);
    }

    public function update(UpdatePrescriptionFulfillmentRequest $request, PrescriptionFulfillment $record): PrescriptionFulfillmentResource
    {
        $record->update($request->validated());

        return new PrescriptionFulfillmentResource($record);
    }

    public function destroy(PrescriptionFulfillment $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
