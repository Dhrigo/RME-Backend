<?php

namespace Modules\LayananLabSensitivityResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabSensitivityResult\Http\Requests\StoreLabSensitivityResultRequest;
use Modules\LayananLabSensitivityResult\Http\Resources\LabSensitivityResultResource;
use Modules\LayananLabSensitivityResult\Models\LabSensitivityResult;

class LabSensitivityResultController extends Controller
{
    public function index(Request $request)
    {
        $query = LabSensitivityResult::query();

        return LabSensitivityResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabSensitivityResultRequest $request)
    {
        $data = $request->validated();

        $sensitivity_result = LabSensitivityResult::create($data);

        return (new LabSensitivityResultResource($sensitivity_result))->response()->setStatusCode(201);
    }

    public function show(LabSensitivityResult $sensitivity_result): LabSensitivityResultResource
    {
        return new LabSensitivityResultResource($sensitivity_result);
    }
}
