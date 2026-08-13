<?php

namespace Modules\MedicalRecordKillipClassAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordKillipClassAssessment\Http\Requests\StoreKillipClassAssessmentRequest;
use Modules\MedicalRecordKillipClassAssessment\Http\Resources\KillipClassAssessmentResource;
use Modules\MedicalRecordKillipClassAssessment\Models\KillipClassAssessment;

class KillipClassAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = KillipClassAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return KillipClassAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreKillipClassAssessmentRequest $request)
    {
        $data = $request->validated();
        $data['rales_present'] ??= false;
        $data['s3_gallop_present'] ??= false;
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = KillipClassAssessment::create($data);

        return (new KillipClassAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(KillipClassAssessment $record): KillipClassAssessmentResource
    {
        return new KillipClassAssessmentResource($record);
    }
}
