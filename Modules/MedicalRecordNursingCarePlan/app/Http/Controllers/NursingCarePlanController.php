<?php

namespace Modules\MedicalRecordNursingCarePlan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingCarePlan\Http\Requests\StoreNursingCarePlanRequest;
use Modules\MedicalRecordNursingCarePlan\Http\Requests\UpdateNursingCarePlanRequest;
use Modules\MedicalRecordNursingCarePlan\Http\Resources\NursingCarePlanResource;
use Modules\MedicalRecordNursingCarePlan\Models\NursingCarePlan;

class NursingCarePlanController extends Controller
{
    public function index(Request $request)
    {
        $query = NursingCarePlan::query();

        return NursingCarePlanResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingCarePlanRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'active';

        $record = NursingCarePlan::create($data);

        return (new NursingCarePlanResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingCarePlan $record): NursingCarePlanResource
    {
        return new NursingCarePlanResource($record);
    }

    public function update(UpdateNursingCarePlanRequest $request, NursingCarePlan $record): NursingCarePlanResource
    {
        $record->update($request->validated());

        return new NursingCarePlanResource($record);
    }

    public function destroy(NursingCarePlan $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
