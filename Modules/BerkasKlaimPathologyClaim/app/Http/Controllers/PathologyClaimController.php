<?php

namespace Modules\BerkasKlaimPathologyClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimPathologyClaim\Http\Requests\StorePathologyClaimRequest;
use Modules\BerkasKlaimPathologyClaim\Http\Requests\UpdatePathologyClaimRequest;
use Modules\BerkasKlaimPathologyClaim\Http\Resources\PathologyClaimResource;
use Modules\BerkasKlaimPathologyClaim\Models\PathologyClaim;

class PathologyClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = PathologyClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return PathologyClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePathologyClaimRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'draft';

        $claim = PathologyClaim::create($data);

        return (new PathologyClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(PathologyClaim $pathology_claim): PathologyClaimResource
    {
        return new PathologyClaimResource($pathology_claim);
    }

    public function update(UpdatePathologyClaimRequest $request, PathologyClaim $pathology_claim): PathologyClaimResource
    {
        if ($pathology_claim->status !== 'draft' && $pathology_claim->status !== 'submitted') {
            abort(422, 'Klaim sudah final.');
        }

        $pathology_claim->update($request->validated());

        return new PathologyClaimResource($pathology_claim->fresh());
    }
}
