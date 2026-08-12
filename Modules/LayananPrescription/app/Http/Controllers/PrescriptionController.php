<?php

namespace Modules\LayananPrescription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPrescription\Http\Requests\StorePrescriptionRequest;
use Modules\LayananPrescription\Http\Resources\PrescriptionResource;
use Modules\LayananPrescription\Models\Prescription;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PrescriptionResource::collection($query->latest('prescribed_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Prescriptions are a legal medical record - append-only, no update/delete,
     * same as ClinicalNote. Corrections belong in a new prescription.
     */
    public function store(StorePrescriptionRequest $request)
    {
        $data = $request->validated();
        $data['prescription_number'] ??= Prescription::generatePrescriptionNumber();
        $data['prescribed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $prescription = Prescription::create($data);

        return (new PrescriptionResource($prescription))->response()->setStatusCode(201);
    }

    public function show(Prescription $prescription): PrescriptionResource
    {
        return new PrescriptionResource($prescription->load('items'));
    }
}
