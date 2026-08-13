<?php

namespace Modules\BerkasKlaimPharmacyClaimItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimPharmacyClaimItem\Http\Requests\StorePharmacyClaimItemRequest;
use Modules\BerkasKlaimPharmacyClaimItem\Http\Resources\PharmacyClaimItemResource;
use Modules\BerkasKlaimPharmacyClaimItem\Models\PharmacyClaimItem;

class PharmacyClaimItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyClaimItem::query();

        if ($request->filled('pharmacy_claim_id')) {
            $query->where('pharmacy_claim_id', $request->integer('pharmacy_claim_id'));
        }

        return PharmacyClaimItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyClaimItemRequest $request)
    {
        $item = PharmacyClaimItem::create($request->validated());

        return (new PharmacyClaimItemResource($item))->response()->setStatusCode(201);
    }

    public function show(PharmacyClaimItem $pharmacy_claim_item): PharmacyClaimItemResource
    {
        return new PharmacyClaimItemResource($pharmacy_claim_item);
    }
}
