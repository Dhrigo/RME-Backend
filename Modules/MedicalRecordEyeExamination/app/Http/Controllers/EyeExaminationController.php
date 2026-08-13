<?php

namespace Modules\MedicalRecordEyeExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEyeExamination\Http\Requests\StoreEyeExaminationRequest;
use Modules\MedicalRecordEyeExamination\Http\Requests\UpdateEyeExaminationRequest;
use Modules\MedicalRecordEyeExamination\Http\Resources\EyeExaminationResource;
use Modules\MedicalRecordEyeExamination\Models\EyeExamination;

class EyeExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = EyeExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return EyeExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreEyeExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = EyeExamination::create($data);

        return (new EyeExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(EyeExamination $record): EyeExaminationResource
    {
        return new EyeExaminationResource($record);
    }

    public function update(UpdateEyeExaminationRequest $request, EyeExamination $record): EyeExaminationResource
    {
        $record->update($request->validated());

        return new EyeExaminationResource($record);
    }

    public function destroy(EyeExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
