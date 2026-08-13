<?php

namespace Modules\PendaftaranReferralLetter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranReferralLetter\Http\Requests\StoreReferralLetterRequest;
use Modules\PendaftaranReferralLetter\Http\Resources\ReferralLetterResource;
use Modules\PendaftaranReferralLetter\Models\ReferralLetter;

class ReferralLetterController extends Controller
{
    public function index(Request $request)
    {
        $query = ReferralLetter::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ReferralLetterResource::collection($query->latest('issued_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreReferralLetterRequest $request)
    {
        $data = $request->validated();
        $data['issued_at'] ??= now();

        $referral = ReferralLetter::create($data);

        return (new ReferralLetterResource($referral))->response()->setStatusCode(201);
    }

    public function show(ReferralLetter $referralletter): ReferralLetterResource
    {
        return new ReferralLetterResource($referralletter);
    }
}
