<?php

namespace Modules\PegawaiEmployeeContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PegawaiEmployeeContact\Http\Requests\StoreEmployeeContactRequest;
use Modules\PegawaiEmployeeContact\Http\Requests\UpdateEmployeeContactRequest;
use Modules\PegawaiEmployeeContact\Http\Resources\EmployeeContactResource;
use Modules\PegawaiEmployeeContact\Models\EmployeeContact;

class EmployeeContactController extends Controller
{
    public function index(Request $request)
    {
        $query = EmployeeContact::query();

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->integer('employee_id'));
        }

        return EmployeeContactResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEmployeeContactRequest $request)
    {
        $contact = EmployeeContact::create($request->validated());

        return (new EmployeeContactResource($contact))->response()->setStatusCode(201);
    }

    public function show(EmployeeContact $employeeContact): EmployeeContactResource
    {
        return new EmployeeContactResource($employeeContact);
    }

    public function update(UpdateEmployeeContactRequest $request, EmployeeContact $employeeContact): EmployeeContactResource
    {
        $employeeContact->update($request->validated());

        return new EmployeeContactResource($employeeContact);
    }

    public function destroy(EmployeeContact $employeeContact)
    {
        $employeeContact->delete();

        return response()->noContent();
    }
}
