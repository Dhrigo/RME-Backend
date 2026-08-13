<?php

namespace Modules\GeneralDoctor\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralDoctor\Http\Requests\StoreDoctorRequest;
use Modules\GeneralDoctor\Http\Requests\UpdateDoctorRequest;
use Modules\GeneralDoctor\Http\Resources\DoctorResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return DoctorResource::collection(Doctor::all());
    }

    public function store(StoreDoctorRequest $request): DoctorResource
    {
        $doctor = Doctor::create($request->validated());
        return new DoctorResource($doctor);
    }

    public function show(Doctor $doctor): DoctorResource
    {
        return new DoctorResource($doctor);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor): DoctorResource
    {
        $doctor->update($request->validated());
        return new DoctorResource($doctor);
    }

    public function destroy(Doctor $doctor): Response
    {
        $doctor->delete();
        return response()->noContent();
    }
}
