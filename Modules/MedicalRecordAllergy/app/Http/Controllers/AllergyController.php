<?php

namespace Modules\MedicalRecordAllergy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAllergy\Http\Requests\StoreAllergyRequest;
use Modules\MedicalRecordAllergy\Http\Requests\UpdateAllergyRequest;
use Modules\MedicalRecordAllergy\Http\Resources\AllergyResource;
use Modules\MedicalRecordAllergy\Models\Allergy;

class AllergyController extends Controller
{
    public function index(Request $request)
    {
        $query = Allergy::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        if ($request->boolean('active_only')) {
            $query->where('is_active', true);
        }

        return AllergyResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAllergyRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $allergy = Allergy::create($data);

        return (new AllergyResource($allergy))->response()->setStatusCode(201);
    }

    public function show(Allergy $allergy): AllergyResource
    {
        return new AllergyResource($allergy);
    }

    public function update(UpdateAllergyRequest $request, Allergy $allergy): AllergyResource
    {
        $allergy->update($request->validated());

        return new AllergyResource($allergy);
    }
}
