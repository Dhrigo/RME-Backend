<?php

namespace Modules\GeneralExaminationGroupMapping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralExaminationGroupMapping\Http\Requests\StoreExaminationGroupMappingRequest;
use Modules\GeneralExaminationGroupMapping\Http\Requests\UpdateExaminationGroupMappingRequest;
use Modules\GeneralExaminationGroupMapping\Http\Resources\ExaminationGroupMappingResource;
use Modules\GeneralExaminationGroupMapping\Models\ExaminationGroupMapping;

class ExaminationGroupMappingController extends Controller
{
    public function index(Request $request)
    {
        $query = ExaminationGroupMapping::query();

        if ($request->filled('examination_group_id')) {
            $query->where('examination_group_id', $request->integer('examination_group_id'));
        }

        return ExaminationGroupMappingResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreExaminationGroupMappingRequest $request)
    {
        $mapping = ExaminationGroupMapping::create($request->validated());

        return (new ExaminationGroupMappingResource($mapping))->response()->setStatusCode(201);
    }

    public function show(ExaminationGroupMapping $examination_group_mapping): ExaminationGroupMappingResource
    {
        return new ExaminationGroupMappingResource($examination_group_mapping);
    }

    public function update(UpdateExaminationGroupMappingRequest $request, ExaminationGroupMapping $examination_group_mapping): ExaminationGroupMappingResource
    {
        $examination_group_mapping->update($request->validated());

        return new ExaminationGroupMappingResource($examination_group_mapping);
    }

    public function destroy(ExaminationGroupMapping $examination_group_mapping)
    {
        $examination_group_mapping->delete();

        return response()->json(null, 204);
    }
}
