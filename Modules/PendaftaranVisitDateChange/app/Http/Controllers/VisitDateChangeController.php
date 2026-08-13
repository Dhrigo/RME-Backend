<?php

namespace Modules\PendaftaranVisitDateChange\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranVisitDateChange\Http\Requests\StoreVisitDateChangeRequest;
use Modules\PendaftaranVisitDateChange\Http\Resources\VisitDateChangeResource;
use Modules\PendaftaranVisitDateChange\Models\VisitDateChange;

class VisitDateChangeController extends Controller
{
    public function index(Request $request)
    {
        $query = VisitDateChange::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return VisitDateChangeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreVisitDateChangeRequest $request)
    {
        $data = $request->validated();
        $data['changed_by'] = $request->user()->id;

        $change = VisitDateChange::create($data);

        return (new VisitDateChangeResource($change))->response()->setStatusCode(201);
    }

    public function show(VisitDateChange $visitdatechange): VisitDateChangeResource
    {
        return new VisitDateChangeResource($visitdatechange);
    }
}
