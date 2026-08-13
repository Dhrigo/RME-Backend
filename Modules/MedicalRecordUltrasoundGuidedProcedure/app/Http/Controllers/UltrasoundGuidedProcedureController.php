<?php

namespace Modules\MedicalRecordUltrasoundGuidedProcedure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordUltrasoundGuidedProcedure\Http\Requests\UltrasoundGuidedProcedureRequest;
use Modules\MedicalRecordUltrasoundGuidedProcedure\Http\Resources\UltrasoundGuidedProcedureResource;
use Modules\MedicalRecordUltrasoundGuidedProcedure\Models\UltrasoundGuidedProcedure;

class UltrasoundGuidedProcedureController extends Controller
{
    public function index(Request $request)
    {
        $query = UltrasoundGuidedProcedure::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return UltrasoundGuidedProcedureResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(UltrasoundGuidedProcedureRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $procedure = UltrasoundGuidedProcedure::create($data);

        return (new UltrasoundGuidedProcedureResource($procedure))->response()->setStatusCode(201);
    }

    public function show(UltrasoundGuidedProcedure $procedure): UltrasoundGuidedProcedureResource
    {
        return new UltrasoundGuidedProcedureResource($procedure);
    }

    public function update(UltrasoundGuidedProcedureRequest $request, UltrasoundGuidedProcedure $procedure): UltrasoundGuidedProcedureResource
    {
        $procedure->update($request->validated());

        return new UltrasoundGuidedProcedureResource($procedure);
    }

    public function destroy(UltrasoundGuidedProcedure $procedure)
    {
        $procedure->delete();

        return response()->json(['message' => 'Ultrasound guided procedure record deleted successfully']);
    }
}
