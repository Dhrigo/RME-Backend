<?php

namespace Modules\MedicalRecordPreAnesthesiaSedationAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPreAnesthesiaSedationAssessment\Http\Requests\StorePreAnesthesiaSedationAssessmentRequest;
use Modules\MedicalRecordPreAnesthesiaSedationAssessment\Http\Resources\PreAnesthesiaSedationAssessmentResource;
use Modules\MedicalRecordPreAnesthesiaSedationAssessment\Models\PreAnesthesiaSedationAssessment;

class PreAnesthesiaSedationAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = PreAnesthesiaSedationAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PreAnesthesiaSedationAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePreAnesthesiaSedationAssessmentRequest $request)
    {
        $data = $request->validated();
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = PreAnesthesiaSedationAssessment::create($data);

        return (new PreAnesthesiaSedationAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(PreAnesthesiaSedationAssessment $record): PreAnesthesiaSedationAssessmentResource
    {
        return new PreAnesthesiaSedationAssessmentResource($record);
    }
}
