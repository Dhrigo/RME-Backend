<?php

namespace Modules\LayananLabMicroscopicResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabMicroscopicResult\Http\Requests\StoreLabMicroscopicResultRequest;
use Modules\LayananLabMicroscopicResult\Http\Resources\LabMicroscopicResultResource;
use Modules\LayananLabMicroscopicResult\Models\LabMicroscopicResult;

class LabMicroscopicResultController extends Controller
{
    public function index(Request $request)
    {
        $query = LabMicroscopicResult::query();

        return LabMicroscopicResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabMicroscopicResultRequest $request)
    {
        $data = $request->validated();

        $microscopic_result = LabMicroscopicResult::create($data);

        return (new LabMicroscopicResultResource($microscopic_result))->response()->setStatusCode(201);
    }

    public function show(LabMicroscopicResult $microscopic_result): LabMicroscopicResultResource
    {
        return new LabMicroscopicResultResource($microscopic_result);
    }
}
