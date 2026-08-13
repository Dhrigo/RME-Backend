<?php

namespace Modules\GeneralMedicalDepartmentWardAssignment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralMedicalDepartmentWardAssignment\Http\Requests\StoreMedicalDepartmentWardAssignmentRequest;
use Modules\GeneralMedicalDepartmentWardAssignment\Http\Requests\UpdateMedicalDepartmentWardAssignmentRequest;
use Modules\GeneralMedicalDepartmentWardAssignment\Http\Resources\MedicalDepartmentWardAssignmentResource;
use Modules\GeneralMedicalDepartmentWardAssignment\Models\MedicalDepartmentWardAssignment;

class MedicalDepartmentWardAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalDepartmentWardAssignment::query();

        if ($request->filled('medical_department_id')) {
            $query->where('medical_department_id', $request->integer('medical_department_id'));
        }

        return MedicalDepartmentWardAssignmentResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalDepartmentWardAssignmentRequest $request)
    {
        $assignment = MedicalDepartmentWardAssignment::create($request->validated());

        return (new MedicalDepartmentWardAssignmentResource($assignment))->response()->setStatusCode(201);
    }

    public function show(MedicalDepartmentWardAssignment $assignment): MedicalDepartmentWardAssignmentResource
    {
        return new MedicalDepartmentWardAssignmentResource($assignment);
    }

    public function update(UpdateMedicalDepartmentWardAssignmentRequest $request, MedicalDepartmentWardAssignment $assignment): MedicalDepartmentWardAssignmentResource
    {
        $assignment->update($request->validated());

        return new MedicalDepartmentWardAssignmentResource($assignment);
    }

    public function destroy(MedicalDepartmentWardAssignment $assignment)
    {
        $assignment->delete();

        return response()->json(null, 204);
    }
}
