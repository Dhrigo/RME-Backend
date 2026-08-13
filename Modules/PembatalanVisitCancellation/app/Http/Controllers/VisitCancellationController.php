<?php

namespace Modules\PembatalanVisitCancellation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanVisitCancellation\Http\Requests\StoreVisitCancellationRequest;
use Modules\PembatalanVisitCancellation\Http\Resources\VisitCancellationResource;
use Modules\PembatalanVisitCancellation\Models\VisitCancellation;

class VisitCancellationController extends Controller
{
    public function index(Request $request)
    {
        $query = VisitCancellation::query();

        return VisitCancellationResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreVisitCancellationRequest $request)
    {
        $data = $request->validated();

        $visit_cancellation = VisitCancellation::create($data);

        return (new VisitCancellationResource($visit_cancellation))->response()->setStatusCode(201);
    }

    public function show(VisitCancellation $visit_cancellation): VisitCancellationResource
    {
        return new VisitCancellationResource($visit_cancellation);
    }
}
