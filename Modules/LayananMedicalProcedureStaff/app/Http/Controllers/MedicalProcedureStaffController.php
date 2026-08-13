<?php

namespace Modules\LayananMedicalProcedureStaff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananMedicalProcedureStaff\Http\Requests\StoreMedicalProcedureStaffRequest;
use Modules\LayananMedicalProcedureStaff\Http\Requests\UpdateMedicalProcedureStaffRequest;
use Modules\LayananMedicalProcedureStaff\Http\Resources\MedicalProcedureStaffResource;
use Modules\LayananMedicalProcedureStaff\Models\MedicalProcedureStaff;

class MedicalProcedureStaffController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalProcedureStaff::query();

        return MedicalProcedureStaffResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalProcedureStaffRequest $request)
    {
        $data = $request->validated();

        $record = MedicalProcedureStaff::create($data);

        return (new MedicalProcedureStaffResource($record))->response()->setStatusCode(201);
    }

    public function show(MedicalProcedureStaff $record): MedicalProcedureStaffResource
    {
        return new MedicalProcedureStaffResource($record);
    }

    public function update(UpdateMedicalProcedureStaffRequest $request, MedicalProcedureStaff $record): MedicalProcedureStaffResource
    {
        $record->update($request->validated());

        return new MedicalProcedureStaffResource($record);
    }

    public function destroy(MedicalProcedureStaff $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
