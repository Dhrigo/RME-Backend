<?php

namespace Modules\LayananLabResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabResult\Http\Requests\StoreLabResultRequest;
use Modules\LayananLabResult\Http\Resources\LabResultResource;
use Modules\LayananLabResult\Models\LabResult;

class LabResultController extends Controller
{
    public function index(Request $request)
    {
        $query = LabResult::query();

        if ($request->filled('lab_order_id')) {
            $query->where('lab_order_id', $request->integer('lab_order_id'));
        }

        return LabResultResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabResultRequest $request)
    {
        $data = $request->validated();
        $data['recorded_at'] ??= now();
        $data['recorded_by'] = $request->user()->id;

        $result = LabResult::create($data);

        return (new LabResultResource($result))->response()->setStatusCode(201);
    }

    public function show(LabResult $lab_result): LabResultResource
    {
        return new LabResultResource($lab_result);
    }
}
