<?php

namespace Modules\MedicalRecordToeExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordToeExamination\Http\Requests\StoreToeExaminationRequest;
use Modules\MedicalRecordToeExamination\Http\Requests\UpdateToeExaminationRequest;
use Modules\MedicalRecordToeExamination\Http\Resources\ToeExaminationResource;
use Modules\MedicalRecordToeExamination\Models\ToeExamination;

class ToeExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = ToeExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ToeExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreToeExaminationRequest $request)
    {
        $data = $request->validated();
        $data['foot_side'] ??= 'both';
        $data['ulceration'] ??= false;
        $data['examined_at'] ??= now();

        $record = ToeExamination::create($data);

        return (new ToeExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(ToeExamination $record): ToeExaminationResource
    {
        return new ToeExaminationResource($record);
    }

    public function update(UpdateToeExaminationRequest $request, ToeExamination $record): ToeExaminationResource
    {
        $record->update($request->validated());

        return new ToeExaminationResource($record);
    }

    public function destroy(ToeExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
