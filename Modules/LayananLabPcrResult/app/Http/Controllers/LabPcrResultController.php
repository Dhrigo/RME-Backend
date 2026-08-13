<?php

namespace Modules\LayananLabPcrResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabPcrResult\Http\Requests\StoreLabPcrResultRequest;
use Modules\LayananLabPcrResult\Http\Resources\LabPcrResultResource;
use Modules\LayananLabPcrResult\Models\LabPcrResult;

class LabPcrResultController extends Controller
{
    public function index(Request $request)
    {
        $query = LabPcrResult::query();

        return LabPcrResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabPcrResultRequest $request)
    {
        $data = $request->validated();

        $pcr_result = LabPcrResult::create($data);

        return (new LabPcrResultResource($pcr_result))->response()->setStatusCode(201);
    }

    public function show(LabPcrResult $pcr_result): LabPcrResultResource
    {
        return new LabPcrResultResource($pcr_result);
    }
}
