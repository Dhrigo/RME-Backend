<?php

namespace Modules\MedicalRecordLowerLegExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordLowerLegExamination\Http\Requests\StoreLowerLegExaminationRequest;
use Modules\MedicalRecordLowerLegExamination\Http\Requests\UpdateLowerLegExaminationRequest;
use Modules\MedicalRecordLowerLegExamination\Http\Resources\LowerLegExaminationResource;
use Modules\MedicalRecordLowerLegExamination\Models\LowerLegExamination;

class LowerLegExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = LowerLegExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return LowerLegExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreLowerLegExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = LowerLegExamination::create($data);

        return (new LowerLegExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(LowerLegExamination $record): LowerLegExaminationResource
    {
        return new LowerLegExaminationResource($record);
    }

    public function update(UpdateLowerLegExaminationRequest $request, LowerLegExamination $record): LowerLegExaminationResource
    {
        $record->update($request->validated());

        return new LowerLegExaminationResource($record);
    }

    public function destroy(LowerLegExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
