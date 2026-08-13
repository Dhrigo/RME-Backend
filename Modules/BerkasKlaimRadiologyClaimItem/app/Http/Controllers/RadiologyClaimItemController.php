<?php

namespace Modules\BerkasKlaimRadiologyClaimItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimRadiologyClaimItem\Http\Requests\StoreRadiologyClaimItemRequest;
use Modules\BerkasKlaimRadiologyClaimItem\Http\Resources\RadiologyClaimItemResource;
use Modules\BerkasKlaimRadiologyClaimItem\Models\RadiologyClaimItem;

class RadiologyClaimItemController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyClaimItem::query();

        if ($request->filled('radiology_claim_id')) {
            $query->where('radiology_claim_id', $request->integer('radiology_claim_id'));
        }

        return RadiologyClaimItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyClaimItemRequest $request)
    {
        $item = RadiologyClaimItem::create($request->validated());

        return (new RadiologyClaimItemResource($item))->response()->setStatusCode(201);
    }

    public function show(RadiologyClaimItem $radiology_claim_item): RadiologyClaimItemResource
    {
        return new RadiologyClaimItemResource($radiology_claim_item);
    }
}
