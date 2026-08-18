<?php

namespace Modules\GeneralNurseWardAssignment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralNurseWardAssignment\Models\NurseWardAssignment;
use Modules\GeneralNurseWardAssignment\Http\Requests\StoreNurseWardAssignmentRequest;
use Modules\GeneralNurseWardAssignment\Http\Requests\UpdateNurseWardAssignmentRequest;
use Modules\GeneralNurseWardAssignment\Http\Resources\NurseWardAssignmentResource;
use Illuminate\Http\Response;

class NurseWardAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = NurseWardAssignment::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return NurseWardAssignmentResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNurseWardAssignmentRequest $request): NurseWardAssignmentResource
    {
        $assignment = NurseWardAssignment::create($request->validated());
        return new NurseWardAssignmentResource($assignment);
    }

    public function show(NurseWardAssignment $nurseWardAssignment): NurseWardAssignmentResource
    {
        return new NurseWardAssignmentResource($nurseWardAssignment);
    }

    public function update(UpdateNurseWardAssignmentRequest $request, NurseWardAssignment $nurseWardAssignment): NurseWardAssignmentResource
    {
        $nurseWardAssignment->update($request->validated());
        return new NurseWardAssignmentResource($nurseWardAssignment);
    }

    public function destroy(NurseWardAssignment $nurseWardAssignment): Response
    {
        $nurseWardAssignment->delete();
        return response()->noContent();
    }
}
