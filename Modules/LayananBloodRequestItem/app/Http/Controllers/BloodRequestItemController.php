<?php

namespace Modules\LayananBloodRequestItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananBloodRequestItem\Http\Requests\StoreBloodRequestItemRequest;
use Modules\LayananBloodRequestItem\Http\Requests\UpdateBloodRequestItemRequest;
use Modules\LayananBloodRequestItem\Http\Resources\BloodRequestItemResource;
use Modules\LayananBloodRequestItem\Models\BloodRequestItem;

class BloodRequestItemController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodRequestItem::query();

        return BloodRequestItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBloodRequestItemRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'pending';

        $record = BloodRequestItem::create($data);

        return (new BloodRequestItemResource($record))->response()->setStatusCode(201);
    }

    public function show(BloodRequestItem $record): BloodRequestItemResource
    {
        return new BloodRequestItemResource($record);
    }

    public function update(UpdateBloodRequestItemRequest $request, BloodRequestItem $record): BloodRequestItemResource
    {
        $record->update($request->validated());

        return new BloodRequestItemResource($record);
    }

    public function destroy(BloodRequestItem $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
