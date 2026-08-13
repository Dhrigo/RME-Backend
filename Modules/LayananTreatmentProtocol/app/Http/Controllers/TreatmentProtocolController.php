<?php

namespace Modules\LayananTreatmentProtocol\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananTreatmentProtocol\Http\Requests\StoreTreatmentProtocolRequest;
use Modules\LayananTreatmentProtocol\Http\Requests\UpdateTreatmentProtocolRequest;
use Modules\LayananTreatmentProtocol\Http\Resources\TreatmentProtocolResource;
use Modules\LayananTreatmentProtocol\Models\TreatmentProtocol;

class TreatmentProtocolController extends Controller
{
    public function index(Request $request)
    {
        $query = TreatmentProtocol::query();

        return TreatmentProtocolResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTreatmentProtocolRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'active';

        $record = TreatmentProtocol::create($data);

        return (new TreatmentProtocolResource($record))->response()->setStatusCode(201);
    }

    public function show(TreatmentProtocol $record): TreatmentProtocolResource
    {
        return new TreatmentProtocolResource($record);
    }

    public function update(UpdateTreatmentProtocolRequest $request, TreatmentProtocol $record): TreatmentProtocolResource
    {
        $record->update($request->validated());

        return new TreatmentProtocolResource($record);
    }

    public function destroy(TreatmentProtocol $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
