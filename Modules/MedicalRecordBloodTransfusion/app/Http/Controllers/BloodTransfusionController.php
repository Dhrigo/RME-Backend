<?php

namespace Modules\MedicalRecordBloodTransfusion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBloodTransfusion\Http\Requests\StoreBloodTransfusionRequest;
use Modules\MedicalRecordBloodTransfusion\Http\Requests\UpdateBloodTransfusionRequest;
use Modules\MedicalRecordBloodTransfusion\Http\Resources\BloodTransfusionResource;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;

class BloodTransfusionController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodTransfusion::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BloodTransfusionResource::collection($query->latest('started_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBloodTransfusionRequest $request)
    {
        $data = $request->validated();
        $data['started_at'] ??= now();
        $data['status'] ??= 'in_progress';
        $data['created_by'] = $request->user()->id;

        $transfusion = BloodTransfusion::create($data);

        return (new BloodTransfusionResource($transfusion))->response()->setStatusCode(201);
    }

    public function show(BloodTransfusion $blood_transfusion): BloodTransfusionResource
    {
        return new BloodTransfusionResource($blood_transfusion);
    }

    /**
     * Only status/ended_at/reaction_notes are correctable post-creation - the
     * transfusion given is not.
     */
    public function update(UpdateBloodTransfusionRequest $request, BloodTransfusion $blood_transfusion): BloodTransfusionResource
    {
        $blood_transfusion->update($request->validated());

        return new BloodTransfusionResource($blood_transfusion);
    }
}
