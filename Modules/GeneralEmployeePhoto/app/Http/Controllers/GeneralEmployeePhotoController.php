<?php

namespace Modules\GeneralEmployeePhoto\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralEmployeePhoto\Models\EmployeePhoto;

class GeneralEmployeePhotoController extends Controller
{
    public function index(Request $request)
    {
        $query = EmployeePhoto::query();

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->integer('employee_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'file_path' => ['required', 'string', 'max:255'],
            'taken_at' => ['required', 'date'],
        ]);

        return response()->json(EmployeePhoto::create($data)->refresh(), 201);
    }

    public function show(EmployeePhoto $employeePhoto): EmployeePhoto
    {
        return $employeePhoto;
    }

    public function update(Request $request, EmployeePhoto $employeePhoto): EmployeePhoto
    {
        $data = $request->validate([
            'file_path' => ['sometimes', 'string', 'max:255'],
            'taken_at' => ['sometimes', 'date'],
        ]);

        $employeePhoto->update($data);

        return $employeePhoto;
    }

    public function destroy(EmployeePhoto $employeePhoto)
    {
        $employeePhoto->delete();

        return response()->json(null, 204);
    }
}
