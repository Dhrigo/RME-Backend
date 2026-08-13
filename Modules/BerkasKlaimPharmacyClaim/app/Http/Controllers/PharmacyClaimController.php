<?php

namespace Modules\BerkasKlaimPharmacyClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimPharmacyClaim\Http\Requests\StorePharmacyClaimRequest;
use Modules\BerkasKlaimPharmacyClaim\Http\Requests\UpdatePharmacyClaimRequest;
use Modules\BerkasKlaimPharmacyClaim\Http\Resources\PharmacyClaimResource;
use Modules\BerkasKlaimPharmacyClaim\Models\PharmacyClaim;

class PharmacyClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return PharmacyClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyClaimRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'draft';

        $claim = PharmacyClaim::create($data);

        return (new PharmacyClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(PharmacyClaim $pharmacy_claim): PharmacyClaimResource
    {
        return new PharmacyClaimResource($pharmacy_claim);
    }

    public function update(UpdatePharmacyClaimRequest $request, PharmacyClaim $pharmacy_claim): PharmacyClaimResource
    {
        if ($pharmacy_claim->status !== 'draft' && $pharmacy_claim->status !== 'submitted') {
            abort(422, 'Klaim sudah final.');
        }

        $pharmacy_claim->update($request->validated());

        return new PharmacyClaimResource($pharmacy_claim->fresh());
    }
}
