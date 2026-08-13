<?php

namespace Modules\MedicalRecordPatientFamilyEducation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPatientFamilyEducation\Http\Requests\StorePatientFamilyEducationRequest;
use Modules\MedicalRecordPatientFamilyEducation\Http\Requests\UpdatePatientFamilyEducationRequest;
use Modules\MedicalRecordPatientFamilyEducation\Http\Resources\PatientFamilyEducationResource;
use Modules\MedicalRecordPatientFamilyEducation\Models\PatientFamilyEducation;

class PatientFamilyEducationController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientFamilyEducation::query();

        return PatientFamilyEducationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientFamilyEducationRequest $request)
    {
        $data = $request->validated();
        $data['re_education_needed'] ??= false;

        $record = PatientFamilyEducation::create($data);

        return (new PatientFamilyEducationResource($record))->response()->setStatusCode(201);
    }

    public function show(PatientFamilyEducation $record): PatientFamilyEducationResource
    {
        return new PatientFamilyEducationResource($record);
    }

    public function update(UpdatePatientFamilyEducationRequest $request, PatientFamilyEducation $record): PatientFamilyEducationResource
    {
        $record->update($request->validated());

        return new PatientFamilyEducationResource($record);
    }

    public function destroy(PatientFamilyEducation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
