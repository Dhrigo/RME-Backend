<?php

namespace Modules\MedicalRecordLabResultSummary\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordLabResultSummary\Http\Requests\StoreLabResultSummaryRequest;
use Modules\MedicalRecordLabResultSummary\Http\Resources\LabResultSummaryResource;
use Modules\MedicalRecordLabResultSummary\Models\LabResultSummary;

class LabResultSummaryController extends Controller
{
    public function index(Request $request)
    {
        $query = LabResultSummary::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return LabResultSummaryResource::collection($query->latest('summarized_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabResultSummaryRequest $request)
    {
        $data = $request->validated();
        $data['summarized_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = LabResultSummary::create($data);

        return (new LabResultSummaryResource($record))->response()->setStatusCode(201);
    }

    public function show(LabResultSummary $record): LabResultSummaryResource
    {
        return new LabResultSummaryResource($record);
    }
}
