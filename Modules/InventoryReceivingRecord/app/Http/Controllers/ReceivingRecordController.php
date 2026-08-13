<?php

namespace Modules\InventoryReceivingRecord\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryReceivingRecord\Http\Requests\StoreReceivingRecordRequest;
use Modules\InventoryReceivingRecord\Http\Resources\ReceivingRecordResource;
use Modules\InventoryReceivingRecord\Models\ReceivingRecord;

class ReceivingRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = ReceivingRecord::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return ReceivingRecordResource::collection($query->latest('received_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Receiving log is append-only once submitted - corrections belong in a new
     * record, not an edit of history (same reasoning as VitalSign).
     */
    public function store(StoreReceivingRecordRequest $request)
    {
        $data = $request->validated();
        $data['received_at'] ??= now();

        $record = ReceivingRecord::create($data);

        return (new ReceivingRecordResource($record))->response()->setStatusCode(201);
    }

    public function show(ReceivingRecord $receiving_record): ReceivingRecordResource
    {
        return new ReceivingRecordResource($receiving_record);
    }
}
