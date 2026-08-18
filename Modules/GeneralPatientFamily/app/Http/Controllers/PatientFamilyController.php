<?php

namespace Modules\GeneralPatientFamily\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientFamily\Http\Requests\StorePatientFamilyRequest;
use Modules\GeneralPatientFamily\Http\Requests\UpdatePatientFamilyRequest;
use Modules\GeneralPatientFamily\Http\Resources\PatientFamilyResource;
use Modules\GeneralPatientFamily\Models\PatientFamily;

class PatientFamilyController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientFamily::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return PatientFamilyResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientFamilyRequest $request)
    {
        $family = PatientFamily::create($request->validated());

        return (new PatientFamilyResource($family))->response()->setStatusCode(201);
    }

    public function show(PatientFamily $patient_family): PatientFamilyResource
    {
        return new PatientFamilyResource($patient_family);
    }

    public function update(UpdatePatientFamilyRequest $request, PatientFamily $patient_family): PatientFamilyResource
    {
        $patient_family->update($request->validated());

        return new PatientFamilyResource($patient_family->fresh());
    }

    public function destroy(PatientFamily $patient_family)
    {
        $patient_family->delete();

        return response()->json(null, 204);
    }
}
