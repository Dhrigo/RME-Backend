<?php

namespace Modules\BerkasKlaimClinicalLabClaimItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimClinicalLabClaimItem\Http\Requests\StoreClinicalLabClaimItemRequest;
use Modules\BerkasKlaimClinicalLabClaimItem\Http\Resources\ClinicalLabClaimItemResource;
use Modules\BerkasKlaimClinicalLabClaimItem\Models\ClinicalLabClaimItem;

class ClinicalLabClaimItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ClinicalLabClaimItem::query();

        if ($request->filled('clinical_lab_claim_id')) {
            $query->where('clinical_lab_claim_id', $request->integer('clinical_lab_claim_id'));
        }

        return ClinicalLabClaimItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreClinicalLabClaimItemRequest $request)
    {
        $item = ClinicalLabClaimItem::create($request->validated());

        return (new ClinicalLabClaimItemResource($item))->response()->setStatusCode(201);
    }

    public function show(ClinicalLabClaimItem $clinical_lab_claim_item): ClinicalLabClaimItemResource
    {
        return new ClinicalLabClaimItemResource($clinical_lab_claim_item);
    }
}
