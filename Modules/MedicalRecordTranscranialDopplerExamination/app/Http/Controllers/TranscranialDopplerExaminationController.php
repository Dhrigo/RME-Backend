<?php

namespace Modules\MedicalRecordTranscranialDopplerExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTranscranialDopplerExamination\Http\Requests\StoreTranscranialDopplerExaminationRequest;
use Modules\MedicalRecordTranscranialDopplerExamination\Http\Requests\UpdateTranscranialDopplerExaminationRequest;
use Modules\MedicalRecordTranscranialDopplerExamination\Http\Resources\TranscranialDopplerExaminationResource;
use Modules\MedicalRecordTranscranialDopplerExamination\Models\TranscranialDopplerExamination;

class TranscranialDopplerExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = TranscranialDopplerExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TranscranialDopplerExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreTranscranialDopplerExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = TranscranialDopplerExamination::create($data);

        return (new TranscranialDopplerExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(TranscranialDopplerExamination $record): TranscranialDopplerExaminationResource
    {
        return new TranscranialDopplerExaminationResource($record);
    }

    public function update(UpdateTranscranialDopplerExaminationRequest $request, TranscranialDopplerExamination $record): TranscranialDopplerExaminationResource
    {
        $record->update($request->validated());

        return new TranscranialDopplerExaminationResource($record);
    }

    public function destroy(TranscranialDopplerExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
