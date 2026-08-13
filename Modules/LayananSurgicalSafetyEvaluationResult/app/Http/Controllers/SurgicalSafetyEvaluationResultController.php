<?php

namespace Modules\LayananSurgicalSafetyEvaluationResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananSurgicalSafetyEvaluationResult\Http\Requests\StoreSurgicalSafetyEvaluationResultRequest;
use Modules\LayananSurgicalSafetyEvaluationResult\Http\Resources\SurgicalSafetyEvaluationResultResource;
use Modules\LayananSurgicalSafetyEvaluationResult\Models\SurgicalSafetyEvaluationResult;

class SurgicalSafetyEvaluationResultController extends Controller
{
    public function index(Request $request)
    {
        $query = SurgicalSafetyEvaluationResult::query();

        return SurgicalSafetyEvaluationResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSurgicalSafetyEvaluationResultRequest $request)
    {
        $data = $request->validated();
        $data['compliant'] = $data['compliant'] ?? true;
        $sst_result = SurgicalSafetyEvaluationResult::create($data);

        return (new SurgicalSafetyEvaluationResultResource($sst_result))->response()->setStatusCode(201);
    }

    public function show(SurgicalSafetyEvaluationResult $sst_result): SurgicalSafetyEvaluationResultResource
    {
        return new SurgicalSafetyEvaluationResultResource($sst_result);
    }
}
