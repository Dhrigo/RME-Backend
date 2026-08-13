<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordMorseFallScaleAssessment\Http\Requests\StoreMorseFallScaleAssessmentRequest;
use Modules\MedicalRecordMorseFallScaleAssessment\Http\Resources\MorseFallScaleAssessmentResource;
use Modules\MedicalRecordMorseFallScaleAssessment\Models\MorseFallScaleAssessment;

class MorseFallScaleAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = MorseFallScaleAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return MorseFallScaleAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMorseFallScaleAssessmentRequest $request)
    {
        $data = $request->validated();
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = MorseFallScaleAssessment::create($data);

        return (new MorseFallScaleAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(MorseFallScaleAssessment $record): MorseFallScaleAssessmentResource
    {
        return new MorseFallScaleAssessmentResource($record);
    }
}
