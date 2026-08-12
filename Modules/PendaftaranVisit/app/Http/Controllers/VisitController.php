<?php

namespace Modules\PendaftaranVisit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranVisit\Http\Requests\StoreVisitRequest;
use Modules\PendaftaranVisit\Http\Requests\UpdateVisitRequest;
use Modules\PendaftaranVisit\Http\Resources\VisitResource;
use Modules\PendaftaranVisit\Models\Visit;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $query = Visit::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        return VisitResource::collection($query->latest('admitted_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreVisitRequest $request)
    {
        $data = $request->validated();
        $data['visit_number'] ??= Visit::generateVisitNumber();
        $data['admitted_at'] ??= now();
        $data['received_by'] = $request->user()->id;

        $visit = Visit::create($data);

        return (new VisitResource($visit))->response()->setStatusCode(201);
    }

    public function show(Visit $visit): VisitResource
    {
        return new VisitResource($visit);
    }

    public function update(UpdateVisitRequest $request, Visit $visit): VisitResource
    {
        $data = $request->validated();

        if (isset($data['discharged_at']) && ! isset($data['final_outcome_by'])) {
            $data['final_outcome_by'] = $request->user()->id;
            $data['final_outcome_at'] = now();
            $data['status'] = $data['status'] ?? 'discharged';
        }

        $visit->update($data);

        return new VisitResource($visit);
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return response()->json(null, 204);
    }
}
