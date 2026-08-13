<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingCarePlanImplementation\Http\Requests\StoreNursingCarePlanImplementationRequest;
use Modules\MedicalRecordNursingCarePlanImplementation\Http\Requests\UpdateNursingCarePlanImplementationRequest;
use Modules\MedicalRecordNursingCarePlanImplementation\Http\Resources\NursingCarePlanImplementationResource;
use Modules\MedicalRecordNursingCarePlanImplementation\Models\NursingCarePlanImplementation;

class NursingCarePlanImplementationController extends Controller
{
    public function index(Request $request)
    {
        $query = NursingCarePlanImplementation::query();

        return NursingCarePlanImplementationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingCarePlanImplementationRequest $request)
    {
        $data = $request->validated();

        $record = NursingCarePlanImplementation::create($data);

        return (new NursingCarePlanImplementationResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingCarePlanImplementation $record): NursingCarePlanImplementationResource
    {
        return new NursingCarePlanImplementationResource($record);
    }

    public function update(UpdateNursingCarePlanImplementationRequest $request, NursingCarePlanImplementation $record): NursingCarePlanImplementationResource
    {
        $record->update($request->validated());

        return new NursingCarePlanImplementationResource($record);
    }

    public function destroy(NursingCarePlanImplementation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
