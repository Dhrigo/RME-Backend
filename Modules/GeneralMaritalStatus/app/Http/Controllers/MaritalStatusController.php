<?php

namespace Modules\GeneralMaritalStatus\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMaritalStatus\Models\MaritalStatus;

class MaritalStatusController extends Controller
{
    public function index()
    {
        return MaritalStatus::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:marital_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:marital_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MaritalStatus::create($data)->refresh(), 201);
    }

    public function show(MaritalStatus $maritalstatus): MaritalStatus
    {
        return $maritalstatus;
    }

    public function update(Request $request, MaritalStatus $maritalstatus): MaritalStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('marital_statuses', 'name')->ignore($maritalstatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('marital_statuses', 'code')->ignore($maritalstatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $maritalstatus->update($data);

        return $maritalstatus;
    }

    public function destroy(MaritalStatus $maritalstatus)
    {
        $maritalstatus->delete();

        return response()->json(null, 204);
    }
}
