<?php

namespace Modules\MedicalRecordDischargePlanningScreening\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDischargePlanningScreening\Http\Requests\StoreDischargePlanningScreeningRequest;
use Modules\MedicalRecordDischargePlanningScreening\Http\Requests\UpdateDischargePlanningScreeningRequest;
use Modules\MedicalRecordDischargePlanningScreening\Http\Resources\DischargePlanningScreeningResource;
use Modules\MedicalRecordDischargePlanningScreening\Models\DischargePlanningScreening;

class DischargePlanningScreeningController extends Controller
{
    public function index(Request $request)
    {
        $query = DischargePlanningScreening::query();

        return DischargePlanningScreeningResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDischargePlanningScreeningRequest $request)
    {
        $data = $request->validated();
        $data['requires_planning'] ??= false;

        $record = DischargePlanningScreening::create($data);

        return (new DischargePlanningScreeningResource($record))->response()->setStatusCode(201);
    }

    public function show(DischargePlanningScreening $record): DischargePlanningScreeningResource
    {
        return new DischargePlanningScreeningResource($record);
    }

    public function update(UpdateDischargePlanningScreeningRequest $request, DischargePlanningScreening $record): DischargePlanningScreeningResource
    {
        $record->update($request->validated());

        return new DischargePlanningScreeningResource($record);
    }

    public function destroy(DischargePlanningScreening $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
