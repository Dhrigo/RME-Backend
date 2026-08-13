<?php

namespace Modules\GeneralMedicalPersonnel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralMedicalPersonnel\Http\Requests\StoreMedicalPersonnelRequest;
use Modules\GeneralMedicalPersonnel\Http\Requests\UpdateMedicalPersonnelRequest;
use Modules\GeneralMedicalPersonnel\Http\Resources\MedicalPersonnelResource;
use Modules\GeneralMedicalPersonnel\Models\MedicalPersonnel;

class MedicalPersonnelController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalPersonnel::query();

        if ($request->filled('personnel_type')) {
            $query->where('personnel_type', $request->string('personnel_type'));
        }

        return MedicalPersonnelResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalPersonnelRequest $request)
    {
        $personnel = MedicalPersonnel::create($request->validated());

        return (new MedicalPersonnelResource($personnel))->response()->setStatusCode(201);
    }

    public function show(MedicalPersonnel $medical_personnel): MedicalPersonnelResource
    {
        return new MedicalPersonnelResource($medical_personnel);
    }

    public function update(UpdateMedicalPersonnelRequest $request, MedicalPersonnel $medical_personnel): MedicalPersonnelResource
    {
        $medical_personnel->update($request->validated());

        return new MedicalPersonnelResource($medical_personnel);
    }

    public function destroy(MedicalPersonnel $medical_personnel)
    {
        $medical_personnel->delete();

        return response()->json(null, 204);
    }
}
