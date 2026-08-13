<?php

namespace Modules\PasienPatientPortalAccount\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PasienPatientPortalAccount\Http\Requests\StorePatientPortalAccountRequest;
use Modules\PasienPatientPortalAccount\Http\Requests\UpdatePatientPortalAccountRequest;
use Modules\PasienPatientPortalAccount\Http\Resources\PatientPortalAccountResource;
use Modules\PasienPatientPortalAccount\Models\PatientPortalAccount;

class PatientPortalAccountController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientPortalAccount::query();

        return PatientPortalAccountResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientPortalAccountRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $portal_account = PatientPortalAccount::create($data);

        return (new PatientPortalAccountResource($portal_account))->response()->setStatusCode(201);
    }

    public function show(PatientPortalAccount $portal_account): PatientPortalAccountResource
    {
        return new PatientPortalAccountResource($portal_account);
    }

    public function update(UpdatePatientPortalAccountRequest $request, PatientPortalAccount $portal_account): PatientPortalAccountResource
    {
        $portal_account->update($request->validated());

        return new PatientPortalAccountResource($portal_account);
    }

    public function destroy(PatientPortalAccount $portal_account)
    {
        $portal_account->delete();

        return response()->json(null, 204);
    }
}
