<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Requests\StoreHumptyDumptyFallScaleAssessmentRequest;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Resources\HumptyDumptyFallScaleAssessmentResource;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Models\HumptyDumptyFallScaleAssessment;

class HumptyDumptyFallScaleAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = HumptyDumptyFallScaleAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return HumptyDumptyFallScaleAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreHumptyDumptyFallScaleAssessmentRequest $request)
    {
        $data = $request->validated();
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = HumptyDumptyFallScaleAssessment::create($data);

        return (new HumptyDumptyFallScaleAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(HumptyDumptyFallScaleAssessment $record): HumptyDumptyFallScaleAssessmentResource
    {
        return new HumptyDumptyFallScaleAssessmentResource($record);
    }
}
