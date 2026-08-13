<?php

namespace Modules\MedicalRecordPharynxExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPharynxExamination\Http\Requests\StorePharynxExaminationRequest;
use Modules\MedicalRecordPharynxExamination\Http\Requests\UpdatePharynxExaminationRequest;
use Modules\MedicalRecordPharynxExamination\Http\Resources\PharynxExaminationResource;
use Modules\MedicalRecordPharynxExamination\Models\PharynxExamination;

class PharynxExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = PharynxExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PharynxExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StorePharynxExaminationRequest $request)
    {
        $data = $request->validated();
        $data['exudate'] ??= false;
        $data['post_nasal_drip'] ??= false;
        $data['examined_at'] ??= now();

        $record = PharynxExamination::create($data);

        return (new PharynxExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(PharynxExamination $record): PharynxExaminationResource
    {
        return new PharynxExaminationResource($record);
    }

    public function update(UpdatePharynxExaminationRequest $request, PharynxExamination $record): PharynxExaminationResource
    {
        $record->update($request->validated());

        return new PharynxExaminationResource($record);
    }

    public function destroy(PharynxExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
