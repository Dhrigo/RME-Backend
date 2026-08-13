<?php

namespace Modules\GeneralPatientAccessLock\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientAccessLock\Http\Requests\StorePatientAccessLockRequest;
use Modules\GeneralPatientAccessLock\Http\Requests\UpdatePatientAccessLockRequest;
use Modules\GeneralPatientAccessLock\Http\Resources\PatientAccessLockResource;
use Modules\GeneralPatientAccessLock\Models\PatientAccessLock;

class PatientAccessLockController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientAccessLock::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return PatientAccessLockResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientAccessLockRequest $request)
    {
        $data = $request->validated();
        $data['locked_at'] ??= now();

        $lock = PatientAccessLock::create($data);

        return (new PatientAccessLockResource($lock))->response()->setStatusCode(201);
    }

    public function show(PatientAccessLock $patient_access_lock): PatientAccessLockResource
    {
        return new PatientAccessLockResource($patient_access_lock);
    }

    public function update(UpdatePatientAccessLockRequest $request, PatientAccessLock $patient_access_lock): PatientAccessLockResource
    {
        $patient_access_lock->update($request->validated());

        return new PatientAccessLockResource($patient_access_lock);
    }

    public function destroy(PatientAccessLock $patient_access_lock)
    {
        $patient_access_lock->delete();

        return response()->json(null, 204);
    }
}
