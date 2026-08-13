<?php

namespace Modules\MedicalRecordParentalHealthHistoryScreening\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordParentalHealthHistoryScreening\Http\Requests\StoreParentalHealthHistoryScreeningRequest;
use Modules\MedicalRecordParentalHealthHistoryScreening\Http\Resources\ParentalHealthHistoryScreeningResource;
use Modules\MedicalRecordParentalHealthHistoryScreening\Models\ParentalHealthHistoryScreening;

class ParentalHealthHistoryScreeningController extends Controller
{
    public function index(Request $request)
    {
        $query = ParentalHealthHistoryScreening::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ParentalHealthHistoryScreeningResource::collection($query->latest('screened_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreParentalHealthHistoryScreeningRequest $request)
    {
        $data = $request->validated();
        $data['consanguinity'] ??= false;
        $data['screened_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = ParentalHealthHistoryScreening::create($data);

        return (new ParentalHealthHistoryScreeningResource($record))->response()->setStatusCode(201);
    }

    public function show(ParentalHealthHistoryScreening $record): ParentalHealthHistoryScreeningResource
    {
        return new ParentalHealthHistoryScreeningResource($record);
    }
}
