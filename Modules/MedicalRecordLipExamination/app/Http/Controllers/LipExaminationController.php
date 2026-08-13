<?php

namespace Modules\MedicalRecordLipExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordLipExamination\Http\Requests\StoreLipExaminationRequest;
use Modules\MedicalRecordLipExamination\Http\Requests\UpdateLipExaminationRequest;
use Modules\MedicalRecordLipExamination\Http\Resources\LipExaminationResource;
use Modules\MedicalRecordLipExamination\Models\LipExamination;

class LipExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = LipExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return LipExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreLipExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = LipExamination::create($data);

        return (new LipExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(LipExamination $record): LipExaminationResource
    {
        return new LipExaminationResource($record);
    }

    public function update(UpdateLipExaminationRequest $request, LipExamination $record): LipExaminationResource
    {
        $record->update($request->validated());

        return new LipExaminationResource($record);
    }

    public function destroy(LipExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
