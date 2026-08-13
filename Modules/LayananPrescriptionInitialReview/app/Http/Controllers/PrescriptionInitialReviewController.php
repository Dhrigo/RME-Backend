<?php

namespace Modules\LayananPrescriptionInitialReview\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPrescriptionInitialReview\Http\Requests\StorePrescriptionInitialReviewRequest;
use Modules\LayananPrescriptionInitialReview\Http\Requests\UpdatePrescriptionInitialReviewRequest;
use Modules\LayananPrescriptionInitialReview\Http\Resources\PrescriptionInitialReviewResource;
use Modules\LayananPrescriptionInitialReview\Models\PrescriptionInitialReview;

class PrescriptionInitialReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionInitialReview::query();

        return PrescriptionInitialReviewResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionInitialReviewRequest $request)
    {
        $data = $request->validated();
        $data['is_appropriate'] ??= true;
        $data['status'] ??= 'reviewed';

        $record = PrescriptionInitialReview::create($data);

        return (new PrescriptionInitialReviewResource($record))->response()->setStatusCode(201);
    }

    public function show(PrescriptionInitialReview $record): PrescriptionInitialReviewResource
    {
        return new PrescriptionInitialReviewResource($record);
    }

    public function update(UpdatePrescriptionInitialReviewRequest $request, PrescriptionInitialReview $record): PrescriptionInitialReviewResource
    {
        $record->update($request->validated());

        return new PrescriptionInitialReviewResource($record);
    }

    public function destroy(PrescriptionInitialReview $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
