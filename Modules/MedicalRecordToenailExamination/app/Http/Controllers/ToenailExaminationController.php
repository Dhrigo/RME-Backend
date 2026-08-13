<?php

namespace Modules\MedicalRecordToenailExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordToenailExamination\Http\Requests\StoreToenailExaminationRequest;
use Modules\MedicalRecordToenailExamination\Http\Requests\UpdateToenailExaminationRequest;
use Modules\MedicalRecordToenailExamination\Http\Resources\ToenailExaminationResource;
use Modules\MedicalRecordToenailExamination\Models\ToenailExamination;

class ToenailExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = ToenailExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ToenailExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreToenailExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = ToenailExamination::create($data);

        return (new ToenailExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(ToenailExamination $record): ToenailExaminationResource
    {
        return new ToenailExaminationResource($record);
    }

    public function update(UpdateToenailExaminationRequest $request, ToenailExamination $record): ToenailExaminationResource
    {
        $record->update($request->validated());

        return new ToenailExaminationResource($record);
    }

    public function destroy(ToenailExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
