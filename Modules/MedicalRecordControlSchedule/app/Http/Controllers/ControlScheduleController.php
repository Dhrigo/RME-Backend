<?php

namespace Modules\MedicalRecordControlSchedule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordControlSchedule\Http\Requests\StoreControlScheduleRequest;
use Modules\MedicalRecordControlSchedule\Http\Requests\UpdateControlScheduleRequest;
use Modules\MedicalRecordControlSchedule\Http\Resources\ControlScheduleResource;
use Modules\MedicalRecordControlSchedule\Models\ControlSchedule;

class ControlScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = ControlSchedule::query();

        return ControlScheduleResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreControlScheduleRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'scheduled';

        $record = ControlSchedule::create($data);

        return (new ControlScheduleResource($record))->response()->setStatusCode(201);
    }

    public function show(ControlSchedule $record): ControlScheduleResource
    {
        return new ControlScheduleResource($record);
    }

    public function update(UpdateControlScheduleRequest $request, ControlSchedule $record): ControlScheduleResource
    {
        $record->update($request->validated());

        return new ControlScheduleResource($record);
    }

    public function destroy(ControlSchedule $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
