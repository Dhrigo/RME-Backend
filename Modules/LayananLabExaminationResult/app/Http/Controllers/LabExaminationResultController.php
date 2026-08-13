<?php

namespace Modules\LayananLabExaminationResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabExaminationResult\Http\Requests\StoreLabExaminationResultRequest;
use Modules\LayananLabExaminationResult\Http\Resources\LabExaminationResultResource;
use Modules\LayananLabExaminationResult\Models\LabExaminationResult;

class LabExaminationResultController extends Controller
{
    public function index(Request $request)
    {
        $query = LabExaminationResult::query();

        return LabExaminationResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabExaminationResultRequest $request)
    {
        $data = $request->validated();
        $data['is_abnormal'] = $data['is_abnormal'] ?? false;
        $exam_result = LabExaminationResult::create($data);

        return (new LabExaminationResultResource($exam_result))->response()->setStatusCode(201);
    }

    public function show(LabExaminationResult $exam_result): LabExaminationResultResource
    {
        return new LabExaminationResultResource($exam_result);
    }
}
