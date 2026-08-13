<?php

namespace Modules\PendaftaranApplicant\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranApplicant\Http\Requests\StoreApplicantRequest;
use Modules\PendaftaranApplicant\Http\Requests\UpdateApplicantRequest;
use Modules\PendaftaranApplicant\Http\Resources\ApplicantResource;
use Modules\PendaftaranApplicant\Models\Applicant;

class ApplicantController extends Controller
{
    public function index(Request $request)
    {
        $query = Applicant::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        return ApplicantResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreApplicantRequest $request)
    {
        $data = $request->validated();
        $data['application_date'] ??= now();
        $data['created_by'] = $request->user()->id;

        $applicant = Applicant::create($data);

        return (new ApplicantResource($applicant))->response()->setStatusCode(201);
    }

    public function show(Applicant $applicant): ApplicantResource
    {
        return new ApplicantResource($applicant);
    }

    public function update(UpdateApplicantRequest $request, Applicant $applicant): ApplicantResource
    {
        $applicant->update($request->validated());

        return new ApplicantResource($applicant);
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();

        return response()->json(null, 204);
    }
}
