<?php

namespace Modules\PendaftaranVisitCancellation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranVisitCancellation\Http\Requests\StoreVisitCancellationRequest;
use Modules\PendaftaranVisitCancellation\Http\Resources\VisitCancellationResource;
use Modules\PendaftaranVisitCancellation\Models\VisitCancellation;

class VisitCancellationController extends Controller
{
    public function index(Request $request)
    {
        $query = VisitCancellation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return VisitCancellationResource::collection($query->latest('cancelled_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreVisitCancellationRequest $request)
    {
        $data = $request->validated();
        $data['cancelled_at'] ??= now();
        $data['cancelled_by'] = $request->user()->id;

        $cancellation = VisitCancellation::create($data);

        return (new VisitCancellationResource($cancellation))->response()->setStatusCode(201);
    }

    public function show(VisitCancellation $visitcancellation): VisitCancellationResource
    {
        return new VisitCancellationResource($visitcancellation);
    }
}
