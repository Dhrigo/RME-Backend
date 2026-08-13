<?php

namespace Modules\MedicalRecordGeneralExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordGeneralExamination\Http\Requests\StoreGeneralExaminationRequest;
use Modules\MedicalRecordGeneralExamination\Http\Requests\UpdateGeneralExaminationRequest;
use Modules\MedicalRecordGeneralExamination\Http\Resources\GeneralExaminationResource;
use Modules\MedicalRecordGeneralExamination\Models\GeneralExamination;

class GeneralExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = GeneralExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return GeneralExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreGeneralExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = GeneralExamination::create($data);

        return (new GeneralExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(GeneralExamination $record): GeneralExaminationResource
    {
        return new GeneralExaminationResource($record);
    }

    public function update(UpdateGeneralExaminationRequest $request, GeneralExamination $record): GeneralExaminationResource
    {
        $record->update($request->validated());

        return new GeneralExaminationResource($record);
    }

    public function destroy(GeneralExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
