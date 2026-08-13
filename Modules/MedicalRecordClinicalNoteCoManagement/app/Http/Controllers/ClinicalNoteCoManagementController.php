<?php

namespace Modules\MedicalRecordClinicalNoteCoManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordClinicalNoteCoManagement\Http\Requests\StoreClinicalNoteCoManagementRequest;
use Modules\MedicalRecordClinicalNoteCoManagement\Http\Requests\UpdateClinicalNoteCoManagementRequest;
use Modules\MedicalRecordClinicalNoteCoManagement\Http\Resources\ClinicalNoteCoManagementResource;
use Modules\MedicalRecordClinicalNoteCoManagement\Models\ClinicalNoteCoManagement;

class ClinicalNoteCoManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = ClinicalNoteCoManagement::query();

        return ClinicalNoteCoManagementResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreClinicalNoteCoManagementRequest $request)
    {
        $data = $request->validated();

        $record = ClinicalNoteCoManagement::create($data);

        return (new ClinicalNoteCoManagementResource($record))->response()->setStatusCode(201);
    }

    public function show(ClinicalNoteCoManagement $record): ClinicalNoteCoManagementResource
    {
        return new ClinicalNoteCoManagementResource($record);
    }

    public function update(UpdateClinicalNoteCoManagementRequest $request, ClinicalNoteCoManagement $record): ClinicalNoteCoManagementResource
    {
        $record->update($request->validated());

        return new ClinicalNoteCoManagementResource($record);
    }

    public function destroy(ClinicalNoteCoManagement $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
