<?php

namespace Modules\LayananTreatmentProtocolStepDrug\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananTreatmentProtocolStepDrug\Http\Requests\StoreTreatmentProtocolStepDrugRequest;
use Modules\LayananTreatmentProtocolStepDrug\Http\Requests\UpdateTreatmentProtocolStepDrugRequest;
use Modules\LayananTreatmentProtocolStepDrug\Http\Resources\TreatmentProtocolStepDrugResource;
use Modules\LayananTreatmentProtocolStepDrug\Models\TreatmentProtocolStepDrug;

class TreatmentProtocolStepDrugController extends Controller
{
    public function index(Request $request)
    {
        $query = TreatmentProtocolStepDrug::query();

        return TreatmentProtocolStepDrugResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTreatmentProtocolStepDrugRequest $request)
    {
        $data = $request->validated();

        $record = TreatmentProtocolStepDrug::create($data);

        return (new TreatmentProtocolStepDrugResource($record))->response()->setStatusCode(201);
    }

    public function show(TreatmentProtocolStepDrug $record): TreatmentProtocolStepDrugResource
    {
        return new TreatmentProtocolStepDrugResource($record);
    }

    public function update(UpdateTreatmentProtocolStepDrugRequest $request, TreatmentProtocolStepDrug $record): TreatmentProtocolStepDrugResource
    {
        $record->update($request->validated());

        return new TreatmentProtocolStepDrugResource($record);
    }

    public function destroy(TreatmentProtocolStepDrug $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
