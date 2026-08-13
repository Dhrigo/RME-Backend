<?php

namespace Modules\GeneralReferralCode\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralReferralCode\Http\Requests\StoreReferralCodeRequest;
use Modules\GeneralReferralCode\Http\Requests\UpdateReferralCodeRequest;
use Modules\GeneralReferralCode\Http\Resources\ReferralCodeResource;
use Modules\GeneralReferralCode\Models\ReferralCode;

class ReferralCodeController extends Controller
{
    public function index(Request $request)
    {
        $query = ReferralCode::query();

        return ReferralCodeResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreReferralCodeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $referral_code = ReferralCode::create($data);

        return (new ReferralCodeResource($referral_code))->response()->setStatusCode(201);
    }

    public function show(ReferralCode $referral_code): ReferralCodeResource
    {
        return new ReferralCodeResource($referral_code);
    }

    public function update(UpdateReferralCodeRequest $request, ReferralCode $referral_code): ReferralCodeResource
    {
        $referral_code->update($request->validated());

        return new ReferralCodeResource($referral_code);
    }

    public function destroy(ReferralCode $referral_code)
    {
        $referral_code->delete();

        return response()->json(null, 204);
    }
}
