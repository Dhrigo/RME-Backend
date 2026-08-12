<?php

namespace Modules\GeneralMedicalDepartment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;

class MedicalDepartmentController extends Controller
{
    public function index()
    {
        return MedicalDepartment::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:medical_departments,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:medical_departments,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MedicalDepartment::create($data)->refresh(), 201);
    }

    public function show(MedicalDepartment $medical_department): MedicalDepartment
    {
        return $medical_department;
    }

    public function update(Request $request, MedicalDepartment $medical_department): MedicalDepartment
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('medical_departments', 'name')->ignore($medical_department->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('medical_departments', 'code')->ignore($medical_department->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $medical_department->update($data);

        return $medical_department;
    }

    public function destroy(MedicalDepartment $medical_department)
    {
        $medical_department->delete();

        return response()->json(null, 204);
    }
}
