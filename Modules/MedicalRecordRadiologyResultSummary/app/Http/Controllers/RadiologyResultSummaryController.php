<?php

namespace Modules\MedicalRecordRadiologyResultSummary\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRadiologyResultSummary\Http\Requests\StoreRadiologyResultSummaryRequest;
use Modules\MedicalRecordRadiologyResultSummary\Http\Resources\RadiologyResultSummaryResource;
use Modules\MedicalRecordRadiologyResultSummary\Models\RadiologyResultSummary;

class RadiologyResultSummaryController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyResultSummary::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return RadiologyResultSummaryResource::collection($query->latest('summarized_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyResultSummaryRequest $request)
    {
        $data = $request->validated();
        $data['summarized_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = RadiologyResultSummary::create($data);

        return (new RadiologyResultSummaryResource($record))->response()->setStatusCode(201);
    }

    public function show(RadiologyResultSummary $record): RadiologyResultSummaryResource
    {
        return new RadiologyResultSummaryResource($record);
    }
}
