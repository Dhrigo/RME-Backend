<?php

namespace Modules\MedicalRecordTonsilExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTonsilExamination\Http\Requests\StoreTonsilExaminationRequest;
use Modules\MedicalRecordTonsilExamination\Http\Requests\UpdateTonsilExaminationRequest;
use Modules\MedicalRecordTonsilExamination\Http\Resources\TonsilExaminationResource;
use Modules\MedicalRecordTonsilExamination\Models\TonsilExamination;

class TonsilExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = TonsilExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TonsilExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreTonsilExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = TonsilExamination::create($data);

        return (new TonsilExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(TonsilExamination $record): TonsilExaminationResource
    {
        return new TonsilExaminationResource($record);
    }

    public function update(UpdateTonsilExaminationRequest $request, TonsilExamination $record): TonsilExaminationResource
    {
        $record->update($request->validated());

        return new TonsilExaminationResource($record);
    }

    public function destroy(TonsilExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
