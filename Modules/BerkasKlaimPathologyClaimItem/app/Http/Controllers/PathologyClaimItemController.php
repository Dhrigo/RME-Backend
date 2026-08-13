<?php

namespace Modules\BerkasKlaimPathologyClaimItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimPathologyClaimItem\Http\Requests\StorePathologyClaimItemRequest;
use Modules\BerkasKlaimPathologyClaimItem\Http\Resources\PathologyClaimItemResource;
use Modules\BerkasKlaimPathologyClaimItem\Models\PathologyClaimItem;

class PathologyClaimItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PathologyClaimItem::query();

        if ($request->filled('pathology_claim_id')) {
            $query->where('pathology_claim_id', $request->integer('pathology_claim_id'));
        }

        return PathologyClaimItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePathologyClaimItemRequest $request)
    {
        $item = PathologyClaimItem::create($request->validated());

        return (new PathologyClaimItemResource($item))->response()->setStatusCode(201);
    }

    public function show(PathologyClaimItem $pathology_claim_item): PathologyClaimItemResource
    {
        return new PathologyClaimItemResource($pathology_claim_item);
    }
}
