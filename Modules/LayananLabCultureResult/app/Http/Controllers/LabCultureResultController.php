<?php

namespace Modules\LayananLabCultureResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabCultureResult\Http\Requests\StoreLabCultureResultRequest;
use Modules\LayananLabCultureResult\Http\Requests\UpdateLabCultureResultRequest;
use Modules\LayananLabCultureResult\Http\Resources\LabCultureResultResource;
use Modules\LayananLabCultureResult\Models\LabCultureResult;

class LabCultureResultController extends Controller
{
    public function index(Request $request)
    {
        $query = LabCultureResult::query();

        return LabCultureResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabCultureResultRequest $request)
    {
        $data = $request->validated();
        $data['result_status'] = $data['result_status'] ?? 'pending';
        $culture_result = LabCultureResult::create($data);

        return (new LabCultureResultResource($culture_result))->response()->setStatusCode(201);
    }

    public function show(LabCultureResult $culture_result): LabCultureResultResource
    {
        return new LabCultureResultResource($culture_result);
    }

    public function update(UpdateLabCultureResultRequest $request, LabCultureResult $culture_result): LabCultureResultResource
    {
        $culture_result->update($request->validated());

        return new LabCultureResultResource($culture_result);
    }
}
