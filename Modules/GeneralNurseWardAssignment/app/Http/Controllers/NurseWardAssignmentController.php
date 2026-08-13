<?php

namespace Modules\GeneralNurseWardAssignment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\GeneralNurseWardAssignment\Models\NurseWardAssignment;
use Modules\GeneralNurseWardAssignment\Http\Requests\StoreNurseWardAssignmentRequest;
use Modules\GeneralNurseWardAssignment\Http\Requests\UpdateNurseWardAssignmentRequest;
use Modules\GeneralNurseWardAssignment\Http\Resources\NurseWardAssignmentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class NurseWardAssignmentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return NurseWardAssignmentResource::collection(NurseWardAssignment::all());
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
