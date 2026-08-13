<?php

namespace Modules\MedicalRecordCatClamsExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordCatClamsExamination\Http\Requests\StoreCatClamsExaminationRequest;
use Modules\MedicalRecordCatClamsExamination\Http\Requests\UpdateCatClamsExaminationRequest;
use Modules\MedicalRecordCatClamsExamination\Http\Resources\CatClamsExaminationResource;
use Modules\MedicalRecordCatClamsExamination\Models\CatClamsExamination;

class CatClamsExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = CatClamsExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return CatClamsExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreCatClamsExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = CatClamsExamination::create($data);

        return (new CatClamsExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(CatClamsExamination $record): CatClamsExaminationResource
    {
        return new CatClamsExaminationResource($record);
    }

    public function update(UpdateCatClamsExaminationRequest $request, CatClamsExamination $record): CatClamsExaminationResource
    {
        $record->update($request->validated());

        return new CatClamsExaminationResource($record);
    }

    public function destroy(CatClamsExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
