<?php

namespace Modules\MedicalRecordPalateExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPalateExamination\Http\Requests\StorePalateExaminationRequest;
use Modules\MedicalRecordPalateExamination\Http\Requests\UpdatePalateExaminationRequest;
use Modules\MedicalRecordPalateExamination\Http\Resources\PalateExaminationResource;
use Modules\MedicalRecordPalateExamination\Models\PalateExamination;

class PalateExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = PalateExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PalateExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StorePalateExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = PalateExamination::create($data);

        return (new PalateExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(PalateExamination $record): PalateExaminationResource
    {
        return new PalateExaminationResource($record);
    }

    public function update(UpdatePalateExaminationRequest $request, PalateExamination $record): PalateExaminationResource
    {
        $record->update($request->validated());

        return new PalateExaminationResource($record);
    }

    public function destroy(PalateExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
