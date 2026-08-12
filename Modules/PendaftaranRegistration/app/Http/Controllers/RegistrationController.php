<?php

namespace Modules\PendaftaranRegistration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranRegistration\Http\Requests\StoreRegistrationRequest;
use Modules\PendaftaranRegistration\Http\Requests\UpdateRegistrationRequest;
use Modules\PendaftaranRegistration\Http\Resources\RegistrationResource;
use Modules\PendaftaranRegistration\Models\Registration;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return RegistrationResource::collection($query->latest('registered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRegistrationRequest $request)
    {
        $data = $request->validated();
        $data['registration_number'] ??= Registration::generateRegistrationNumber();
        $data['registered_at'] ??= now();
        $data['registered_by'] = $request->user()->id;

        $registration = Registration::create($data);

        return (new RegistrationResource($registration))->response()->setStatusCode(201);
    }

    public function show(Registration $registration): RegistrationResource
    {
        return new RegistrationResource($registration);
    }

    public function update(UpdateRegistrationRequest $request, Registration $registration): RegistrationResource
    {
        $registration->update($request->validated());

        return new RegistrationResource($registration);
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return response()->json(null, 204);
    }
}
