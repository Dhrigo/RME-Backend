<?php

namespace Modules\MedicalRecordEkgExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEkgExamination\Http\Requests\StoreEkgExaminationRequest;
use Modules\MedicalRecordEkgExamination\Http\Requests\UpdateEkgExaminationRequest;
use Modules\MedicalRecordEkgExamination\Http\Resources\EkgExaminationResource;
use Modules\MedicalRecordEkgExamination\Models\EkgExamination;

class EkgExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = EkgExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return EkgExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreEkgExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = EkgExamination::create($data);

        return (new EkgExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(EkgExamination $record): EkgExaminationResource
    {
        return new EkgExaminationResource($record);
    }

    public function update(UpdateEkgExaminationRequest $request, EkgExamination $record): EkgExaminationResource
    {
        $record->update($request->validated());

        return new EkgExaminationResource($record);
    }

    public function destroy(EkgExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
