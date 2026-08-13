<?php

namespace Modules\LayananPrescriptionFulfillmentItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPrescriptionFulfillmentItem\Http\Requests\StorePrescriptionFulfillmentItemRequest;
use Modules\LayananPrescriptionFulfillmentItem\Http\Requests\UpdatePrescriptionFulfillmentItemRequest;
use Modules\LayananPrescriptionFulfillmentItem\Http\Resources\PrescriptionFulfillmentItemResource;
use Modules\LayananPrescriptionFulfillmentItem\Models\PrescriptionFulfillmentItem;

class PrescriptionFulfillmentItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionFulfillmentItem::query();

        return PrescriptionFulfillmentItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionFulfillmentItemRequest $request)
    {
        $data = $request->validated();
        $data['is_substituted'] ??= false;

        $record = PrescriptionFulfillmentItem::create($data);

        return (new PrescriptionFulfillmentItemResource($record))->response()->setStatusCode(201);
    }

    public function show(PrescriptionFulfillmentItem $record): PrescriptionFulfillmentItemResource
    {
        return new PrescriptionFulfillmentItemResource($record);
    }

    public function update(UpdatePrescriptionFulfillmentItemRequest $request, PrescriptionFulfillmentItem $record): PrescriptionFulfillmentItemResource
    {
        $record->update($request->validated());

        return new PrescriptionFulfillmentItemResource($record);
    }

    public function destroy(PrescriptionFulfillmentItem $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
