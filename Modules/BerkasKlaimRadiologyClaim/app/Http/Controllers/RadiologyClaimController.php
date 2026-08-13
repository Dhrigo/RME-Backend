<?php

namespace Modules\BerkasKlaimRadiologyClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimRadiologyClaim\Http\Requests\StoreRadiologyClaimRequest;
use Modules\BerkasKlaimRadiologyClaim\Http\Requests\UpdateRadiologyClaimRequest;
use Modules\BerkasKlaimRadiologyClaim\Http\Resources\RadiologyClaimResource;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;

class RadiologyClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return RadiologyClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyClaimRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'draft';

        $claim = RadiologyClaim::create($data);

        return (new RadiologyClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(RadiologyClaim $radiology_claim): RadiologyClaimResource
    {
        return new RadiologyClaimResource($radiology_claim);
    }

    public function update(UpdateRadiologyClaimRequest $request, RadiologyClaim $radiology_claim): RadiologyClaimResource
    {
        if ($radiology_claim->status !== 'draft' && $radiology_claim->status !== 'submitted') {
            abort(422, 'Klaim sudah final.');
        }

        $radiology_claim->update($request->validated());

        return new RadiologyClaimResource($radiology_claim->fresh());
    }
}
