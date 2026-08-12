<?php

namespace Modules\PendaftaranReferral\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranReferral\Http\Requests\StoreReferralRequest;
use Modules\PendaftaranReferral\Http\Requests\UpdateReferralRequest;
use Modules\PendaftaranReferral\Http\Resources\ReferralResource;
use Modules\PendaftaranReferral\Models\Referral;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        $query = Referral::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return ReferralResource::collection($query->latest('referred_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreReferralRequest $request)
    {
        $data = $request->validated();
        $data['referral_number'] = Referral::generateReferralNumber();
        $data['referred_at'] ??= now();

        $referral = Referral::create($data);

        return (new ReferralResource($referral))->response()->setStatusCode(201);
    }

    public function show(Referral $referral): ReferralResource
    {
        return new ReferralResource($referral);
    }

    public function update(UpdateReferralRequest $request, Referral $referral): ReferralResource
    {
        $referral->update($request->validated());

        return new ReferralResource($referral);
    }
}
