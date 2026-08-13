<?php

namespace Modules\MedicalRecordEpfraAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEpfraAssessment\Http\Requests\StoreEpfraAssessmentRequest;
use Modules\MedicalRecordEpfraAssessment\Http\Requests\UpdateEpfraAssessmentRequest;
use Modules\MedicalRecordEpfraAssessment\Http\Resources\EpfraAssessmentResource;
use Modules\MedicalRecordEpfraAssessment\Models\EpfraAssessment;

class EpfraAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = EpfraAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return EpfraAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreEpfraAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = EpfraAssessment::create($data);

        return (new EpfraAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(EpfraAssessment $record): EpfraAssessmentResource
    {
        return new EpfraAssessmentResource($record);
    }

    public function update(UpdateEpfraAssessmentRequest $request, EpfraAssessment $record): EpfraAssessmentResource
    {
        $record->update($request->validated());

        return new EpfraAssessmentResource($record);
    }

    public function destroy(EpfraAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
