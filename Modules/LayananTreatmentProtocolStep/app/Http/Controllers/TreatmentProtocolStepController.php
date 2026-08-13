<?php

namespace Modules\LayananTreatmentProtocolStep\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananTreatmentProtocolStep\Http\Requests\StoreTreatmentProtocolStepRequest;
use Modules\LayananTreatmentProtocolStep\Http\Requests\UpdateTreatmentProtocolStepRequest;
use Modules\LayananTreatmentProtocolStep\Http\Resources\TreatmentProtocolStepResource;
use Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep;

class TreatmentProtocolStepController extends Controller
{
    public function index(Request $request)
    {
        $query = TreatmentProtocolStep::query();

        return TreatmentProtocolStepResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTreatmentProtocolStepRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'pending';

        $record = TreatmentProtocolStep::create($data);

        return (new TreatmentProtocolStepResource($record))->response()->setStatusCode(201);
    }

    public function show(TreatmentProtocolStep $record): TreatmentProtocolStepResource
    {
        return new TreatmentProtocolStepResource($record);
    }

    public function update(UpdateTreatmentProtocolStepRequest $request, TreatmentProtocolStep $record): TreatmentProtocolStepResource
    {
        $record->update($request->validated());

        return new TreatmentProtocolStepResource($record);
    }

    public function destroy(TreatmentProtocolStep $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
