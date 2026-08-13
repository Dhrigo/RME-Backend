<?php

namespace Modules\MedicalRecordFunctionalStatusAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFunctionalStatusAssessment\Http\Requests\StoreFunctionalStatusAssessmentRequest;
use Modules\MedicalRecordFunctionalStatusAssessment\Http\Resources\FunctionalStatusAssessmentResource;
use Modules\MedicalRecordFunctionalStatusAssessment\Models\FunctionalStatusAssessment;

class FunctionalStatusAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = FunctionalStatusAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return FunctionalStatusAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFunctionalStatusAssessmentRequest $request)
    {
        $data = $request->validated();
        $data['bathing_status'] ??= 'independent';
        $data['dressing_status'] ??= 'independent';
        $data['toileting_status'] ??= 'independent';
        $data['transferring_status'] ??= 'independent';
        $data['feeding_status'] ??= 'independent';
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = FunctionalStatusAssessment::create($data);

        return (new FunctionalStatusAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(FunctionalStatusAssessment $record): FunctionalStatusAssessmentResource
    {
        return new FunctionalStatusAssessmentResource($record);
    }
}
