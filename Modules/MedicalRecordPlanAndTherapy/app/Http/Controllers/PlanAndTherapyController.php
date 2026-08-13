<?php

namespace Modules\MedicalRecordPlanAndTherapy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPlanAndTherapy\Http\Requests\StorePlanAndTherapyRequest;
use Modules\MedicalRecordPlanAndTherapy\Http\Resources\PlanAndTherapyResource;
use Modules\MedicalRecordPlanAndTherapy\Models\PlanAndTherapy;

class PlanAndTherapyController extends Controller
{
    public function index(Request $request)
    {
        $query = PlanAndTherapy::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PlanAndTherapyResource::collection($query->latest('ordered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePlanAndTherapyRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'active';
        $data['ordered_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = PlanAndTherapy::create($data);

        return (new PlanAndTherapyResource($record))->response()->setStatusCode(201);
    }

    public function show(PlanAndTherapy $record): PlanAndTherapyResource
    {
        return new PlanAndTherapyResource($record);
    }
}
