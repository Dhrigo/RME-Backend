<?php

namespace Modules\BerkasKlaimClinicalLabClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimClinicalLabClaim\Http\Requests\StoreClinicalLabClaimRequest;
use Modules\BerkasKlaimClinicalLabClaim\Http\Requests\UpdateClinicalLabClaimRequest;
use Modules\BerkasKlaimClinicalLabClaim\Http\Resources\ClinicalLabClaimResource;
use Modules\BerkasKlaimClinicalLabClaim\Models\ClinicalLabClaim;

class ClinicalLabClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = ClinicalLabClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return ClinicalLabClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreClinicalLabClaimRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'draft';

        $claim = ClinicalLabClaim::create($data);

        return (new ClinicalLabClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(ClinicalLabClaim $clinical_lab_claim): ClinicalLabClaimResource
    {
        return new ClinicalLabClaimResource($clinical_lab_claim);
    }

    public function update(UpdateClinicalLabClaimRequest $request, ClinicalLabClaim $clinical_lab_claim): ClinicalLabClaimResource
    {
        if ($clinical_lab_claim->status !== 'draft' && $clinical_lab_claim->status !== 'submitted') {
            abort(422, 'Klaim sudah final.');
        }

        $clinical_lab_claim->update($request->validated());

        return new ClinicalLabClaimResource($clinical_lab_claim->fresh());
    }
}
