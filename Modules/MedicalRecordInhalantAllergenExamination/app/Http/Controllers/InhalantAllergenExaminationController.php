<?php

namespace Modules\MedicalRecordInhalantAllergenExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordInhalantAllergenExamination\Http\Requests\StoreInhalantAllergenExaminationRequest;
use Modules\MedicalRecordInhalantAllergenExamination\Http\Requests\UpdateInhalantAllergenExaminationRequest;
use Modules\MedicalRecordInhalantAllergenExamination\Http\Resources\InhalantAllergenExaminationResource;
use Modules\MedicalRecordInhalantAllergenExamination\Models\InhalantAllergenExamination;

class InhalantAllergenExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = InhalantAllergenExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return InhalantAllergenExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreInhalantAllergenExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = InhalantAllergenExamination::create($data);

        return (new InhalantAllergenExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(InhalantAllergenExamination $record): InhalantAllergenExaminationResource
    {
        return new InhalantAllergenExaminationResource($record);
    }

    public function update(UpdateInhalantAllergenExaminationRequest $request, InhalantAllergenExamination $record): InhalantAllergenExaminationResource
    {
        $record->update($request->validated());

        return new InhalantAllergenExaminationResource($record);
    }

    public function destroy(InhalantAllergenExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
