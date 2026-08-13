<?php

namespace Modules\MedicalRecordEmergencyEducation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEmergencyEducation\Http\Requests\StoreEmergencyEducationRequest;
use Modules\MedicalRecordEmergencyEducation\Http\Requests\UpdateEmergencyEducationRequest;
use Modules\MedicalRecordEmergencyEducation\Http\Resources\EmergencyEducationResource;
use Modules\MedicalRecordEmergencyEducation\Models\EmergencyEducation;

class EmergencyEducationController extends Controller
{
    public function index(Request $request)
    {
        $query = EmergencyEducation::query();

        return EmergencyEducationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEmergencyEducationRequest $request)
    {
        $data = $request->validated();

        $record = EmergencyEducation::create($data);

        return (new EmergencyEducationResource($record))->response()->setStatusCode(201);
    }

    public function show(EmergencyEducation $record): EmergencyEducationResource
    {
        return new EmergencyEducationResource($record);
    }

    public function update(UpdateEmergencyEducationRequest $request, EmergencyEducation $record): EmergencyEducationResource
    {
        $record->update($request->validated());

        return new EmergencyEducationResource($record);
    }

    public function destroy(EmergencyEducation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
