<?php

namespace Modules\GeneralEmployee\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralEmployee\Http\Requests\StoreEmployeeRequest;
use Modules\GeneralEmployee\Http\Requests\UpdateEmployeeRequest;
use Modules\GeneralEmployee\Http\Resources\EmployeeResource;
use Modules\GeneralEmployee\Models\Employee;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->string('name').'%');
        }

        return EmployeeResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return (new EmployeeResource($employee))->response()->setStatusCode(201);
    }

    public function show(Employee $employee): EmployeeResource
    {
        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
